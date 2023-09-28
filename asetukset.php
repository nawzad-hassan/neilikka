<?php
$PALVELIN = $_SERVER['HTTP_HOST'];
$PALVELU = "xampp/";
$LINKKI_RESETPASSWORD = "resetpassword.php";
$LINKKI_VERIFICATION = "verification.php";
$PALVELUOSOITE = "asiakaspalvelu@neilikka.fi";
define("OLETUSSIVU", "profiili.php");
define ("PROFIILIKUVAKANSIO", "profiilikuvat");
define ("PROFIILIKUVAKOKO", "profiilikuvat");
$DB = "neilikka";
$LOCAL = in_array($_SERVER['REMOTE_ADDR'],array('127.0.0.1', 'REMOTE_ADDR' =>'::1'));
if ($local) {
    $tunnukset = "../../../tunnukset.php";
    if (file_exists($tunnukset)) {
        include_once("../../../tunnukset.php");
    }
 
else {
    die("Tiedostoa ei löydy, ota yhteys ylläpitoon.");
}
$db_server = $db_server_local;
$db_username = $db_username_local;
$db_password = $db_password_local;
$EMAIL_ADMIN = $admin_mail;
}
elseif (strpos($_SERVER['HTTP_HOST'], "azurewebsites") !== false) {
        $db_server = $_ENV["MYSQL_HOSTNAME"];
        $db_username = $_ENV["MYSQL_USER"];
        $db_password = $_ENV["MYSQL_PASSWORD"];
}
    else {
        die("Tiedostoa ei löydy, ota yhteys ylläpitoon.");
    }
    $db_server = $db_server_remote;
    $db_username = $db_username_remote;
    $db_password = $db_password_remote;
}
else {
    $tunnukset = "/home/epedu/public_html/tunnukset.php";
    if (file_exists($tunnukset)) {
        include_once("/home/epedu/public_html/tunnukset.php");
    }
    else {
        die("Tiedostoa ei löydy, ota yhteys ylläpitoon.");
    }
    $db_server = $db_server_remote;
    $db_username = $db_username_remote;
    $db_password = $db_password_remote;
}

?>