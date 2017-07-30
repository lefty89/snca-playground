<!DOCTYPE html>
<html>
<head>
    <title>SNCA Playground</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <style type="text/css">
        html {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer a {
            vertical-align: top;
            display: inline-flex;
            font-weight: bold;
            text-decoration: none !important;
        }
        footer i {
            font-size: 20px !important;
            padding-right: 5px;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="row hidden-xs-up" id="result-alert" style="padding-top: 100px">
                <div class="col-md-12">
                    <div id="result-alert-class"></div>
                </div>
            </div>
            <div class="container-fluid hidden-xs-up" id="result-box">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#m1">Header</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m2">Claims</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m3">Payload</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m4">Signature</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m5">Public Key (PKCS#8)</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#m6">Google Certs</a></li>
                    <li class="nav-item ml-auto"><a class="nav-link text-muted" href="/">Reset</a></li>
                </ul>
                <div class="tab-content">
                    <div id="m1" class="tab-pane active">
                        <pre><code id="r-header"></code></pre>
                    </div>
                    <div id="m2" class="tab-pane fade">
                        <pre><code id="r-claims"></code></pre>
                    </div>
                    <div id="m3" class="tab-pane fade">
                        <pre><code id="r-payload"></code></pre>
                    </div>
                    <div id="m4" class="tab-pane fade">
                        <pre><code id="r-sig"></code></pre>
                    </div>
                    <div id="m5" class="tab-pane fade">
                        <pre><code id="r-key"></code></pre>
                    </div>
                    <div id="m6" class="tab-pane fade">
                        <pre><code id="r-certs"></code></pre>
                    </div>
                </div>
            </div style="padding-top: 100px">
            <div class="row" style="padding: 100px 0">
                <div class="col-md-12">
                    <form action="https://accounts.google.com/o/oauth2/v2/auth">
                        <div class="form-group">
                            <label>Redirect URI</label>
                            <input class="form-control" type="text" name="redirect_uri"  value="http://snca.bugcluster.xyz" readonly>
                            <small class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label>Client ID</label>
                            <input class="form-control" type="text" name="client_id" value="422119840927-662evl0vdf08n3cfhrtgjvpgic4ntnpo.apps.googleusercontent.com" readonly>
                            <small class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Nonce</label>
                                    <input class="form-control" type="text" name="nonce" value="123456">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <label>State</label>
                                    <input class="form-control" type="text" name="state" value="abcdef">
                                    <small class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                    <label>Access Type</label>
                                    <input class="form-control" type="text" name="access_type" value="offline">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <label>Scope</label>
                                    <input class="form-control" type="text" name="scope" value="openid profile">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <label>Promt</label>
                                    <input class="form-control" type="text" name="prompt" value="consent">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <label>Response Type</label>
                                    <input class="form-control" type="text" name="response_type" value="id_token">
                                    <small class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <button role="button" type="submit" class="btn btn-primary form-control">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-faded mt-4">
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-md-12 text-right small align-self-end ">
                    <a class="text-muted" href="https://github.com/lefty89/snca-playground" target="_blank">
                        <i class="fa fa-github"></i>
                        SNCA Playground
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        /**
         * Have to use implicit login flow else there would be
         * no id_token delivered
         */
        document.addEventListener("DOMContentLoaded", function(event) {
            // get token from url
            var anchor = window.location.hash;
            if (anchor !== "") {
                var token = anchor.substring(anchor.indexOf("id_token=")+9);
                var url   = "/snca.php?token="+token;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var json = JSON.parse(this.responseText);

                        // format alert value box
                        if (!json.err) {
                            document.getElementById("result-box").classList.remove("hidden-xs-up");
                            // update values
                            document.getElementById("r-header").innerHTML  = json.header;
                            document.getElementById("r-claims").innerHTML  = json.claims;
                            document.getElementById("r-payload").innerHTML = json.payload;
                            document.getElementById("r-certs").innerHTML   = json.certs;
                            document.getElementById("r-key").innerHTML     = json.key;
                            document.getElementById("r-sig").innerHTML     = json.sig;
                        }

                        // format alert box
                        document.getElementById("result-alert").classList.remove("hidden-xs-up");
                        document.getElementById("result-alert-class").className = (json.err)?
                            "alert alert-danger" : "alert alert-success";
                        document.getElementById("result-alert-class").innerHTML = json.msg;
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            }
        });

    </script>
</body>
</html> 