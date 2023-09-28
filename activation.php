<?php
include "db.php";
$email_verified = $email_already_verified = $activation_error = "";
$token = $_GET['token'];
if ($token){
$token = $yhteys->real_escape_string($token);
$query = "SELECT users_id, is_active FROM signup_tokens s.token
LEFT JOIN users ON users.id = id WHERE s.token = '$token'";
$result = mysqli_query($yhteys, $query);
$countRow = $result->num_rows;
if ($countRow) {
    list($id, $is_active) = $result->fetch_row();
    if (!$is_active == 0) {
        $query = "UPDATE users SET is_active = '1' WHERE id = '$id'";
        $result = $yhteys->query($query);
        if ($result) {
            $email_verified = 
            '<div class="alert alert-success">
            Sähköpostiosoitteesi on vahvistettu.
            </div>';
            }
        } 
    } else {
        $email_already_verified = 
        '<div class="alert alert-warning">
        Sähköpostiosoitteesi on jo vahvistettu.
        </div>';
    }
}
?>