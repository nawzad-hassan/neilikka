<?php
$tietokanta = "neilikka";
$title = 'Rekisteröitymislomake';
include 'virheilmoitukset.php';
$virheilmoitukset_json = json_encode($virheilmoitukset);
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include 'header.php';
include_once 'db.php';
//include "posts.php";
include 'rekisterointi.php';
?>
<div class="container">
<form method="post" class="mb-3 needs-validation" novalidate>
<fieldset>
<legend>Rekisteröityminen</legend>
<form>
<form>
<div class="row">
<label for="firstname" class="col-sm-3 form-label">Etunimi:</label>
<div class="col-sm-6">
<input type="text" class="mb-1 form-control <?= is_invalid('firstname');?>" name="firstname" 
placeholder="Etunimi" value="<?= arvo("firstname");?>" required autofocus>
<!--<div class="invalid-feedback">-->
<!--<?= $errors['etunimi'] ?? "";?>-->
<!--</div>-->
</div>
</div>

<div class="row">
<label for="lastname" class="col-sm-3 form-label">Sukunimi:</label>
<div class="col-md-6">
<input type="text" class="mb-1 form-control <?= is_invalid('lastname');?>" name="lastname" 
placeholder="Sukunimi" value="<?= arvo("lastname");?>" required>
<div class="invalid-feedback">
<?= $errors['sukunimi'] ?? "";?>
</div>
</div>
</div>

<div class="row">
<label for="address" class="col-sm-3 form-label">Katuosoite:</label>
<div class="col-sm-6">
<input type="text" class="mb-1 form-control" id="address" name="address" value="<?= arvo("address");?>" required>
<div class="invalid-feedback">
<?= $errors['katuosoite'] ?? "";?>
</div>
</div>
</div>

<div class="row">
<label for="zip" class="col-sm-3 form-label">Postinumero:</label>
<div class="col-sm-6">
<input type="text" class="mb-1 form-control" id="zip" name="zip" value="<?= arvo("zip");?>" required>
<div class="invalid-feedback">
<?= $errors['postinumero'] ?? "";?>
</div>
</div>
</div>

<div class="row">
<label for="city" class="col-sm-3 form-label">Postitoimipaikka:</label>
<div class="col-sm-6">
<input type="text" class="mb-1 form-control" id="city" name="address" value="<?= arvo("city");?>" required>
<div class="invalid-feedback">
<?= $errors['postitoimipaikka'] ?? "";?>
</div>
</div>
</div>

<div class="row">
<label for="email" class="col-sm-3 form-label">Sähköpostiosoite:</label>
<div class="col-sm-6">
<input type="email" class="mb-1 form-control" <?= is_invalid('email');?> name="email" id="email"
placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email");?>" pattern="<?= pattern('email'); ?>" required>
<div class="invalid-feedback">
<?= $errors['email'] ?? ""; ?>
</div>
</div>
</div>

<div class="row">
<label for="phone" class="col-sm-3 form-label">Puhelinnumero:</label>
<div class="col-sm-6">
<input type="text" class="mb-1 form-control" <?= is_invalid('phone');?> name="phone" id="phone" 
value="<?= arvo("phone");?>" pattern="<?= pattern('phone'); ?>" required>


</div>
</div>
</div>



<!--<div class="row">
<label for="name" class="form-label">Nimi:</label>
<input type="text" class="form-control" name="nimi" id="name" placeholder="Etunimi Sukunimi" value="" required><br></br>
</div class="invalid-feedback">

<label for="address">Katuosoite:</label>
<input type="text" id="address" name="address"><br></br>

<label for="zip">Postinumero:</label>
<input type="text" id="zip" name="zip" minlength="5" maxlength="5"><br></br>

<label for="city">Postitoimipaikka:</label>
<input type="text" id="city" name="city"><br></br>

<label for="phone">Puhelinnumero:</label>
<input pattern= "^[\d ()+-]{7,15}" type="text" id="phone" name="phone" placeholder="358xx1234567"><br></br>

<label for="email">Sähköpostiosoite:</label>
<input type="email" id="email" name="email" placeholder="etunimi.sukunimi@example.com"><br></br>-->




<div class="row">
<label for="password" class="col-sm-3 form-label">Salasana:</label>
<div class="col-sm-6">
<input type="password" class="mb-1 form-control <?= is_invalid('password');?>" name="password"
placeholder="salasana" pattern="<?= pattern('password');?>" required>
<div class="invalid-feedback">
<?= $errors['password'] ?? "";?>

</div>
</div>
</div>

<div class="row">
<label for="password2" class="text-nowrap col-sm-3 form-label">Salasana uudestaan:</label>
<div class="col-sm-6">
<input type="password" class="mb-1 form-control <?= is_invalid('password2');?>" name="password2"
placeholder="salasana uudestaan" pattern="<?= pattern('password2');?>" required>
<div class="invalid-feedback">
<?= $errors['password2'] ?? "";?>
</div>
</div>
</div>
</div>
</fieldset>

<!-- Kiinnosstuksen kohteet-->

<div class="text-container">
<p>Mistä osastoista olet kiinnostunut?</p>
</div>

<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="fasion">
<label class="form-check-label" for="flexCheckDefault">
Muoti<br></br>  
<input class="form-check-input" type="checkbox" value="" id="sports">
<label class="form-check-label" for="flexCheckDefault">
Urheilu<br></br>

<input class="form-check-input" type="checkbox" value="" id="decore">
<label class="form-check-label" for="flexCheckDefault">
Sisustaminen<br></br>

<input class="form-check-input" type="checkbox" value="" id="game">
<label class="form-check-label" for="flexCheckDefault">
Peli<br></br>

<input class="form-check-input" type="checkbox" value="" id="movies">
<label class="form-check-label" for="flexCheckDefault">
Elokuvat<br></br>
</label>
</div>

<!--Maksutapa-->
<lable for="payment">Maksutapa:</lable>
<select id="payment" name="payment">
    <option value="sampo">Sampo</option>
    <option value="Nordea">Nordea</option>
    <option value="OsuusPankki">OP Pankki</option>
    <option value="Säästöpankki">Säästöpankki</option>
    <option value="Nettipankki">Aktia</option>

</select><br><br>

<!-- palaute-->
<label for="feedback">Anna palautetta</label><br>
<textarea id="feedback" name="feedback" rows="4" cols="50"></textarea><br><br>

<!--Toimistusehdot-->
<lable>Olen lukennut ja hyväksyn tuoteiden toimitusehdot</lable><br>
<input type="radio" id="yes" name="terms" value="yes" required>
<label for="yes">Kyllä</label><br>

<input type="radio" id="no" name="terms" value="no" required>
<label for="no">Ei</label><br><br>

<!--Lähestyspainike-->

<button name="button" type="submit" class= "mt-2 float-end btn btn-primary">Rekisteröidy</button>
 
<br></br>
</fieldset>
</form>
<div id="ilmoitukset" class="alert-success alert-dismissible fade show" <?= $display; ?> role="alert">
<p><?php $message; ?></p>
<!--<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
</div>
</div>

<?php include 'footer.html'; ?>


