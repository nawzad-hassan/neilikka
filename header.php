<?php

if (!session_id()) session_start();
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include_once "debuggeri.php";
if (!isset($loggedIn)) {
include "rememberme.php";
$loggedIn = loggedIn();
}
debuggeri("loggedIn:$loggedIn");
register_shutdown_function('debuggeri_shutdown');
$active = basename ($_SERVER['PHP_SELF'], ".php");
function active($sivu, $active) {
   return $active == $sivu ? 'active' : '';
  }
?>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
<!--<script defer src="scripts.js"></script>-->
<link rel ="omnialogo" href="omnialogo.png">
<link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="site.css">
<linki rel="stylesheet" href="footer.css">
<!--<script src="vieritys.js"></script>-->
<?php if (isset($css)) echo "<link rel='link rel='stylesheet' href='$css'>"; ?>
<script defer src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="scripts.js"></script>
<title><?=$title ?? 'Neilikka'; ?></title>
</head>

<nav>
    <!--<input type="checkbox" id="toggle-btn">-->
    <img src="omnialogo.png" alt="Logo">
    <label for="toggle-btn" class="icon open"><i class="fa fa-times"></i></label>
    <label for="toggle-btn" class="icon close"><i class="fa fa-bars"></i></label>
    <a class="<?= ($active == 'kuvagalleria') ? 'active' : ''; ?>" href="kuvagalleria.php">kuvagalleria</a>
    <a class="<?= ($active == 'profiili') ? 'active' : ''; ?>" href="profiili.php">profiili</a>
    <a class="<?= ($active == 'rekisteroitymislomake') ? 'active' : ''; ?>" href="rekisteroitymislomale.php">rekisteroitymislomake</a>
    <a class="<?= ($active == 'infophp') ? 'active' : '' ;?>" href="infophp.php">infophp</a>
    <!--<a class="<?= ($active == 'login') ? 'active' : ''; ?>" href="login.php">login</a>-->
   <a class="<?= ($active == 'rekisteroitymislomake') ? 'active' : ''; ?>" href="rekisteroitymislomake.php">kirjautuminen</a>
   
<?php
if ($loggedIn){
echo "<a class='".active('profiili',$active)."' href='profiili.php'>profiili</a>";
echo '<a class="nav-suojaus" href="poistu.php">Poistu</a>';
    
}

if ($loggedIn == 'admin') {
    echo "<a class='".active('profiili',$active)."' href='kayttajat.php'>Käyttäjät</a>";
    //echo "<a class='nav-suojaus ".active('rekisteroitymislomake', $active)."' href='rekisteroitymislomake.php'>Rekisteröidy</a>";
}

if (!$loggedIn) {
    echo "<a class='nav-suojaus ".active('login', $active)."' href='login.php'>Kirjauttuminen</a>";
}
 ?>
</nav>
