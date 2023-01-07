<?php
session_start();

$korisnicko = "";
$mejl_adresa    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'kalendarapp');


// REGISTER korisnik
if (isset($_POST['reg_korisnika'])) {
  $korisnicko = mysqli_real_escape_string($db, $_POST['korisnicko']);
  $mejl_adresa = mysqli_real_escape_string($db, $_POST['mejl_adresa']);
  $lozinka = mysqli_real_escape_string($db, $_POST['lozinka']);
  $lozinka_2 = mysqli_real_escape_string($db, $_POST['lozinka_2']);
  $ime = mysqli_real_escape_string($db, $_POST['ime']);
  $prezime = mysqli_real_escape_string($db, $_POST['prezime']);
  $datum_rodjenja = mysqli_real_escape_string($db, $_POST['datum_rodjenja']);
  $tip_zaposlenja = mysqli_real_escape_string($db, $_POST['tip_zaposlenja']);

  $get_datum = getdate();
  $epoch = $get_datum[0];
  $kreiran = date('Y-m-d H:i:s', $epoch);

  //provera da li je forma dobro popunjena: push poruke
  if (empty($lozinka)) { array_push($errors, "Unesite lozinku"); }
  if ($lozinka != $lozinka_2) {array_push($errors, "Lozinke se ne poklapaju");}
 
  //provera da li je korisnicko ime zauzeto
  $da_li_korisnik_postoji = "SELECT * FROM svi_korisnici WHERE korisnicko='$korisnicko' OR mejl_adresa='$mejl_adresa' LIMIT 1";
  $rezultat = mysqli_query($db, $da_li_korisnik_postoji);
  $korisnik = mysqli_fetch_assoc($rezultat);
  
  if ($korisnik) { //ako korisnik vec postoji
    if ($korisnik['korisnicko'] === $korisnicko) {
      array_push($errors, "Ovo korisničko ime je već u upotrebi");
    }
    if ($korisnik['mejl_adresa'] === $mejl_adresa) {
      array_push($errors, "Ova mejl adresa je već u upotrebi");
    }
  }

  if (count($errors) == 0) { //ako nije doslo do greski pri upisu forme
    $lozinka = md5($lozinka); // md5 hash
    $query = "INSERT INTO svi_korisnici (korisnicko, mejl_adresa, lozinka, kreiran, ime, prezime, datum_rodjenja, tip_zaposlenja) 
          VALUES('$korisnicko', '$mejl_adresa', '$lozinka', '$kreiran', '$ime', '$prezime', '$datum_rodjenja', '$tip_zaposlenja')";
    mysqli_query($db, $query);
    $query = "INSERT INTO nacin_obavljanja (idKorisnika) 
          VALUES('$korisnicko')";
    mysqli_query($db, $query);
    $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "Ulogovani ste!";
    header('location: index.php');
  }

}

// LOGIN korisnik
if (isset($_POST['log_korisnika'])) {
  $korisnicko = mysqli_real_escape_string($db, $_POST['korisnicko']);
  $lozinka = mysqli_real_escape_string($db, $_POST['lozinka']);


  if (empty($korisnicko)) {
    array_push($errors, "Unesite korisničko ime");
  }
  if (empty($lozinka)) {
    array_push($errors, "Unesite lozinku");
  }

  if (count($errors) == 0) {
    $lozinka = md5($lozinka);
    $query = "SELECT * FROM svi_korisnici WHERE korisnicko='$korisnicko' AND lozinka='$lozinka'";
    $rezultat = mysqli_query($db, $query);
    if (mysqli_num_rows($rezultat) == 1) {
      $_SESSION['korisnicko'] = $korisnicko;
      $_SESSION['success'] = "Ulogovani ste!";
      header('location: index.php');
    }else {
      array_push($errors, "Pogrešna kombinacija korisničkog imena i lozinke");
    }
  }
}



//POSTAVI NACIN OBAVLJANJA POSLA
// PONEDELJAK

if (isset($_POST['obavljanjePoslaPonedeljak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['ponedeljak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET ponedeljak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}


//POSTAVI NACIN OBAVLJANJA POSLA
// PONEDELJAK

if (isset($_POST['obavljanjePoslaPonedeljak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['ponedeljak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET ponedeljak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// PONEDELJAK

if (isset($_POST['obavljanjePoslaPonedeljak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['ponedeljak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET ponedeljak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}
//POSTAVI NACIN OBAVLJANJA POSLA
// utorak

if (isset($_POST['obavljanjePoslaUtorak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['utorak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET utorak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// SREDA

if (isset($_POST['obavljanjePoslaSreda'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['sreda']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET sreda='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// CETVRTAK

if (isset($_POST['obavljanjePoslaCetvrtak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['cetvrtak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET cetvrtak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// PETAK

if (isset($_POST['obavljanjePoslaPetak'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['petak']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET petak='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// SUBOTA

if (isset($_POST['obavljanjePoslaSubota'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['subota']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET subota='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}

//POSTAVI NACIN OBAVLJANJA POSLA
// NEDELJA

if (isset($_POST['obavljanjePoslaNedelja'])) {
  // receive all input values from the form
  $dan = mysqli_real_escape_string($db, $_POST['nedelja']);

   if ($_SESSION['korisnicko']){
    $korisnicko = $_SESSION['korisnicko'];
    if (count($errors) == 0) {
    $upit = "UPDATE nacin_obavljanja SET nedelja='$dan' WHERE idKorisnika='$korisnicko'";
    mysqli_query($db, $upit);

   // $_SESSION['korisnicko'] = $korisnicko;
    $_SESSION['success'] = "";
    header('location: kalendar.php');
    }
  }
}


?>
