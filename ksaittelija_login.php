<?php

if (isset($_POST['painike'])) {
    foreach ($_POST as $kentta => $arvo) {
        $kentat = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        if (in_array($kentta, $pakolliset) and empty($arvo)) {
            $errors[$kentta] = $virheilmoitukset[$kentta]['valueMissing'];
        }
    else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = $virheilmoitukset[$kentta]['patternMismatch'];
        }
      }
    }
}
list($virheet, $arvot) = validoi_lomake($kentat);
debuggeri($virheet);
    if ($virheet){
    //$email = $arvot[array_search('email',$kentat)];
    //$password = $arvot[array_search('password',$kentat)];
   // $rememberme = $arvot[array_search('rememberme',$kentat)];
$query = "SELECT id, password, is_actice FROM users WHERE email ='email'";
$result = $yhteys->prepare($query);
    if (!$result) die("Tietokantayhteys ei toimii: ".mysqli_error($connection));
    if (!$result->num_rows){
        $virheet_palvelin[] = $virheilmoitukset['accouontNotExistErr'];
        }
else {  
[$id, $password_hash, $is_active, $role] = $result->fetch_row();
if (password_verify($password, $password_hash)){
if ($is_active) {
    if (!session_id()) session_start();
    $_SESSION["loggedIn"] = $role;
    if ($rememberme) rememberme($id);
    if (isset($_SESSION['nextpage'])) {
        $location = $_SESSION['nextpage'];
        unset($_SESSION['nextpage']);
        }
        else $location = OLETUSSIVU; 
        header("location: $location");
        exit;
        }
        else {
        $errors['email'] = $virheilmoitukset['verificationRequiredErr'];
        }
    }
    else {
        $errors['password'] = $virheilmoitukset['emailPwdErr'];
        }
   }
}


?>