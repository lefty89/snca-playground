<?php
include('vendor/autoload.php');

/**
 * Includes
 */
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Parsing\Decoder;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

// response var
$response = array("err" => 1, "msg" => "Unknown error");

// main logic
$id_token = "";
if (isset($_GET["token"])) {
    $id_token = $_GET["token"];

    if (verifyJwt($id_token)) {
        $response['msg'] = "Validation successfull (RSA PKCS#1 signature with SHA-256)";
        $response['err'] = 0;
    }
    else {$response['msg'] = "Signature validation failed";}
}
else {$response['msg'] = "No token given";}

// return results
echo json_encode($response);

/**
 * Parses a jwt token
 * @param $id_token
 * @return bool
 */
function verifyJwt($id_token) {
    try{
        $token = (new Parser())->parse((string) $id_token);     // Parses from a string
        $headers = $token->getHeaders();                        // Retrieves the token header

        // fetch certs from google
        $pubKey = fetchPublicCerts($headers['kid']);

        // add to return var
        global $response;
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
function fetchPublicCerts($kid) {
    $json = file_get_contents('https://www.googleapis.com/oauth2/v3/certs');

    // add to return var
    global $response;
    $response['certs'] = $json;

    $obj = json_decode($json);
    foreach  ($obj->keys as $key) {
        if ($key->kid == $kid) {

            $rsa = new RSA();
            $dec = new Decoder();

            $modulus  = new BigInteger($dec->base64UrlDecode($key->n), 256);
            $exponent = new BigInteger($dec->base64UrlDecode($key->e), 256);

            $rsa->loadKey(array('n' => $modulus, 'e' => $exponent));
            // https://tls.mbed.org/kb/cryptography/asn1-key-structures-in-der-and-pem
            return $rsa->getPublicKey();
        }
    }
    return null;
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