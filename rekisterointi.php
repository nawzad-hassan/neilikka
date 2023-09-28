
<?php 
$display = "d-none";
$message = "";
$lisays = $lisattiin_token = $lahetetty = false;
$errors = [];

$patterns['password'] ="/^.{12,}$/";
$patterns['password2'] = $patterns['password'];
$patterns['firstname'] = "/^[a-zåäöA-ZÅÄÖ'-]+$/";
$patterns['lastname'] = $patterns['firstname'];
$patterns['email'] = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$patterns['phone'] = "/^[\d ()+-]{7,15}$/";
$patterns['address'] = "/^[a-zA-ZåäöÅÄÖ]{2,}+$/";
$patterns['zip'] = "/^[0-9]{5}$/";
$patterns['city'] = "/^[a-zA-ZåäöÅÄÖ]{2,}+$/";
$patterns['img'] = "/^[^\s]+(\.(?i)(jpg|png|gif|bmp))$/";
$patterns['rememberme'] = "/^checked/";

//$errors['firstname'] = $virhetekstit['firstname']['puuttuu'];
function pattern($kentta) {
    return trim($GLOBALS['patterns'][$kentta], "/");
}
function error($kentta) {
    return $GLOBALS['errors'][$kentta] ?? $GLOBALS['virhetekstit'][$kentta]['puuttuu'];
}

function arvo($kentta) {
    return $_POST[$kentta] ?? "";
    
}

function is_invalid($kentta) {
    return (isset($GLOBALS['errors'][$kentta])) ? "is-invalid" : "";
    
}

if (isset($_POST['button'])) {

$_SERVER['REQUEST_METHOD'] == 'POST';

foreach($_POST as $kentta => $arvo) {
    $kentta = $yhteys->real_escape_string(strip_tags(trim(($arvo))));
    if (in_array($kentta, $pakolliset) and empty($arvo)){ 
        $errors[$kentta] = $virhetekstit[$kentta]['valueMissing'];
    }
    else {
        if (isset($patterns[$kentta]) and !preg_match($patterns($kentta), $arvo)) {
            $errors[$kentta] = $virheilmoitukset[$kentta]['patternMismatch'];
        }
    } 
}

if(empty($errors['password2']) and empty($errors['password'])) {
    if ($_POST['password'] != $_POST['password2']) {
        $errors['password2'] = $virheilmoitukset['password2']['customError'];
    }
}


$query = "SELECT * FROM users WHERE email = '$email'";
$result = $yhteys->query($query);
if ($result->num_rows > 0){
    $errors['email'] = $virheilmoitukset['email']['emailExistError'];
}

$query = "SELECT * FROM users WHERE firstname = '$firstname' AND lastname = '$lastname'";
$result = $yhteys->query($query);
if ($result->num_rows > 0){
    $errors['firstname'] = $virheilmoitukset['firstname']['nameExistError'];
    $errors['lastname'] = $virheilmoitukset['lastname']['nameExistError'];
}

debuggeri($errors);
if (empty($errors)) {
    $created = date("Y-m-d");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (firstname, lastname, email, password) 
    VALUES ('$firstname', '$lastname', '$email', '$password')";
    $result = $yhteys->query($query);
    $lisays = $yhteys->affected_rows;
}

if (empty($errors)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (firstname, lastname, email, password) 
    VALUES ('$firstname', '$lastname', '$email', '$password')";
    $result = $yhteys->query($query);
    if ($result) {
        $message = "Rekisteröinti onnistui!";
        $display = "d-block";
    }
    else {
        $message = "Rekisteröinti epäonnistui!";
        $display = "d-block";
    }

}
    else {
        $message = "Rekisteröinti epäonnistui!";
        $display = "d-block";
}


if ($result) {
    $id = $yhteys->insert_id;
    $token = md5(rand().time());
    $query = "INSERT INTO signup_tokens (token, user_id) VALUES ($id, '$token')";
    debuggeri($query);
    $result = $yhteys->query($query);
    $lisattiin_token = $yhteys->affected_rows;
}
if ($lisays)    {
    $id = $yhteys->insert_id;
    $token = md5(rand().time());
    $query = "INSERT INTO signup_tokens (token, user_id) VALUES ($id, '$token')";
    debuggeri($query);
    $result = $yhteys->query($query);
    $lisattiin_token = $yhteys->affected_rows;

}
if($result){
    $msg = "Vahvista sähköpostiosoitteesi:<br><br>";
    $msg .= "<a href='http://$PALVELIN/$PALVELU/verification.php?token=$token'>Vahvista</a>";
    $subject = "Vahvista sähköpostiosoitteesi";
    $lahetetty = posti($email, $msg, $subject);

}
if ($lisattiin_token) {
    $msg = "Vahvista sähköpostiosoitteesi:<br><br>";
    $msg .= "<a href='http://$PALVELIN/$PALVELU/verification.php?token=$token'>Vahvista</a>";
    $msg .= "<br><br>t. $PALVELUOSOITE";
    $subject = "vahvista sähköpostiosoite";
    $lahetetty = posti($email, $msg, $subject);

}

if ($lahetetty) {
    $message = "Tiedot on tallennettu. Sinulla on lähetetty antamaasi sähköpostiosoitteeseen vahvistuspyyntö. 
    Vahvista siinä olevasta linkistä sähköpostiosoitteesi";
}
elseif ($lisays){
    $message = "Tallennus onnistui";
    }
    else {
        $message = "Tallennus epäonnistui";
        $success = "danger";
    }
    $display = "d-block";


var_export($_POST);
echo "<br>";
var_export($errors);
}
?>
