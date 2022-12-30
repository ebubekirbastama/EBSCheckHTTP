<!DOCTYPE html>
<html lang="en">
    <head>
    <title>EBS Check HTTP(www.ebubekirbastama.com)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

    <div class="container">
        <h2>CheckHTTP Form(www.ebubekirbastama.com)</h2>
        <p></p>
        <form class="form-inline" method="POST">
            <div class="form-group">
                <label for="url">Url: </label>
                <input  class="form-control" id="url" placeholder="Enter Url" name="url">
            </div>

            <button type="submit" class="btn btn-danger">Kontrol Et</button>
        </form>
    </div>

</body>
</html>


<?php
if (isset($_POST['url'])) {

    $SUrl = $_POST['url'];
    $httpCode = EBSCurlGet($SUrl);
    $returnUrl = EBSCurlReturnUrl($SUrl);

    print_r('<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Kontrol Edilecek Url</th>
      <th scope="col">Http Code</th>
      <th scope="col">Bitiş Url</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><a href="' . $SUrl . '">' . $SUrl . '</a></td>
      <td>' . $httpCode . '</td>
      <td><a href="' . $returnUrl . '">' . $returnUrl . '</a></td>
    </tr>

  </tbody>
</table>
            ');
}

function EBSCurlGet($Url) {
    // Ebubekir Bastama https://www.ebubekirbastama.com
    $ch = curl_init($Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);

    if (!curl_errno($ch)) {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }
    curl_close($ch);
    if (empty($http_code)) {
        $http_code = "Veri Yok";
    }
    return $http_code;
}

function EBSCurlReturnUrl($Url) {
    // Ebubekir Bastama https://www.ebubekirbastama.com
    $ch = curl_init($Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);

    if (!curl_errno($ch)) {
        $Returnurll = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $info = curl_getinfo($ch);
    }
    curl_close($ch);
    if (empty($info["redirect_url"])) {
        return "Veri Yok";
    }
    return $info["redirect_url"];
}

//[Informational 1xx]
//100="Continue"
//101="Switching Protocols"
//
//[Successful 2xx]
//200="OK"
//201="Created"
//202="Accepted"
//203="Non-Authoritative Information"
//204="No Content"
//205="Reset Content"
//206="Partial Content"
//
//[Redirection 3xx]
//300="Multiple Choices"
//301="Moved Permanently"
//302="Found"
//303="See Other"
//304="Not Modified"
//305="Use Proxy"
//306="(Unused)"
//307="Temporary Redirect"
//
//[Client Error 4xx]
//400="Bad Request"
//401="Unauthorized"
//402="Payment Required"
//403="Forbidden"
//404="Not Found"
//405="Method Not Allowed"
//406="Not Acceptable"
//407="Proxy Authentication Required"
//408="Request Timeout"
//409="Conflict"
//410="Gone"
//411="Length Required"
//412="Precondition Failed"
//413="Request Entity Too Large"
//414="Request-URI Too Long"
//415="Unsupported Media Type"
//416="Requested Range Not Satisfiable"
//417="Expectation Failed"
//
//[Server Error 5xx]
//500="Internal Server Error"
//501="Not Implemented"
//502="Bad Gateway"
//503="Service Unavailable"
//504="Gateway Timeout"
//505="HTTP Version Not Supported"
