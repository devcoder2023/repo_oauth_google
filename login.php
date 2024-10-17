<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>AOuth Google</title>
</head>
<body>

<?php
require __DIR__ . '/vendor/autoload.php';
$clientID = '';
$clientSecret = 'GOCSPX-';
$redirectURI = 'http://localhost:3002/example_oauth/login.php';

$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

if(isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google\Service\Oauth2($client);

    $userinfo = $google_oauth->userinfo->get();
    echo "Welcome:<br>";
    var_dump(
        $userinfo->email,
        $userinfo->familyName,
        $userinfo->givenName,
        $userinfo->name,
    );
    echo "<br>code: " .$_GET['code']. "<br>";
     
    echo "End.";

} else {

}

?>
<div class="wrraper">

    <div class="widgetlogin">
        <h1> <?php echo "Hellow !"; ?> </h1>
        <a href="<?php echo $url ?>"><div id="buttonLogin" class="buttons">Login With Google</div></a>
    </div>





</div>

</body>
</html>
