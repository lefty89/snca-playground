<?php
include('vendor/autoload.php');

/**
 * Includes
 */
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

// response var
$response = array();

$id_token = "";
if (isset($_GET["token"])) {
    $id_token = $_GET["token"];
}

if (!empty($id_token)) {
    if (verifyJwt($response, $id_token)) {
        $response['err'] = 0; }
    else {
        $response['err'] = 1;}
} else {
    $response['err'] = 1;}


// return results
echo json_encode($response);

/**
 * Parses a jwt token
 * @param $id_token
 * @return bool
 */
function verifyJwt(&$response, $id_token) {
    try{
        $token = (new Parser())->parse((string) $id_token);     // Parses from a string
        $headers = $token->getHeaders();                        // Retrieves the token header

        $pubKey = fetchPublicCerts($response, $headers['kid']);

        // return
        $response['header']  = json_encode($headers,             JSON_PRETTY_PRINT);
        $response['claims']  = json_encode($token->getClaims(),  JSON_PRETTY_PRINT);
        $response['payload'] = $token->getPayload();
        $response['key']     = $pubKey;
        $response['sig']     = substr($id_token, strrpos($id_token,'.')+1);

        if (!is_null($pubKey)) {
            $signer = new Sha256();
            return $token->verify($signer, $pubKey);
        }
    }
    catch(Exception $e) {
        return false;
    }
}

/**
 * Gets the public Key
 * @param $kid
 * @return bool|null|string
 */
function fetchPublicCerts(&$response, $kid) {
    $json = file_get_contents('https://www.googleapis.com/oauth2/v3/certs');

    // return
    $response['certs']  = $json;

    $obj = json_decode($json);
    foreach  ($obj->keys as $key) {
        if ($key->kid == $kid) {

            $rsa = new RSA();
            $modulus  = new BigInteger(base64_url_decode($key->n), 256);
            $exponent = new BigInteger(base64_url_decode($key->e), 256);

            $rsa->loadKey(array('n' => $modulus, 'e' => $exponent));
            // https://tls.mbed.org/kb/cryptography/asn1-key-structures-in-der-and-pem
            return $rsa->getPublicKey();
        }
    }
    return null;
}

/**
 * URL+Base64 decoder
 * @param $input
 * @return string
 */
function base64_url_decode($input) {
    return base64_decode( strtr( $input, '-_', '+/' ) );
}

/**
 * Logger function
 * @param $log
 */
function logger($log) {
    // file to save the log to
    $filename = $_SERVER['DOCUMENT_ROOT'].'/logs/log-'.date('y-m-j+h-i-s').'.txt';

    //Save string to log, use FILE_APPEND to append.
    file_put_contents($filename, $log);
}