<?php
$displaY = "d-none";
$message = "";
$success ="success";
$muutettu = $poistettu_token = false;
$virhet_palvelin['invalidLink'] = "Salasanan aktivointilinkki ei ole voimassa.";
$virhet_palvelin['invalidLink'] = "Virheellinen linkki";
$token = $_GET['token'] ?? '';
if ($token) {
/*Haetan email*/
$date = date('Y-m-d');
$token = $yhteys->real_escape_string(strip_tags(trim($token)));
$query = "SELECT user_id FROM resetpassword_tokens WHERE token = '$token' AND valid_until voimassa > '$date'";
debuggeri($query);
$result = $yhteys->query($query);
if (!list($user_id) = $result->fetch_row()) {
    debuggeri("Virheellinen token.");
    $message = $virhet_palvelin['invalidLink'];
    $displaY = "d-block";
    $success = "danger";    
}
else { 
     $message = $virhet_palvelin['invalidLink'];
     $displaY = "d-block";
     $success = "danger";
     }

if (isset($_POST['painike']) and !$message){
    foreach ($_POST as $kentta => $arvo) {
        if (in_array($kentta, $pakolliset) and empty($arvo)) {
            $errors[$kentta] = $virheilmoitukset[$kentta]['valueMissing'];
            }
  else {
    if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
        $errors[$kentta] = $virheilmoitukset[$kentta]['patternMismatch'];
  }
else {
    if (is_array($arvo)) $$kentta = $arvo;
    else $$kentta = $yhteys->real_escape_string(strip_tags(trim($arvo)));
      }
    }
}
if (empty($errors['password2']) and empty($errors['password'])) {
    if ($_POST['password'] != $_POST['password2']) {
        $errors['password2'] = $virheilmoitukset['password2']['customError'];}
    }
}
   
    debuggeri($errors);
    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
        $result = $yhteys->query($query);
        $muutettu = $yhteys->affected_rows;
    }
        if ($muutettu) {
            $query = "DELETE FROM resetpassword_tokens WHERE users_id = '$user_id'";
            debuggeri($query);
            $result = $yhteys->query($query);
            $poistettu_token = $yhteys->affected_rows;
            debuggeri("Poistettiin $poistettu_token token.");
            header("location: login.php");
            exit
        }
        if ($lahetetty) {
            $message = "Tiedot on tallennettu. Sinulla on lähetty antamaasi sähköpostiosoitteeseen linkki 
            vahvistuspyyntöön. Vahvista siinä olevasta linkistä sähköpostiosoitteesi.";
        }
        elseif ($lisays) {

            $message = "Tallennus onnistui!";
        }
        else {
            $message = "Tallennus epäonnistui!";
            $success = "danger";
           
        }
    }

?>