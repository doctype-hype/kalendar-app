<?php include('server.php'); 

  if (!isset($_SESSION['korisnicko'])) {
    $_SESSION['msg'] = "Ulogujte se da pristupite stranici";
    header('location: login.php');
  }
  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['korisnicko']);
    header("location: login.php");
  }

  $db = mysqli_connect('localhost', 'root', '', 'kalendarapp');

  if( mysqli_connect_errno() ) {
    echo "Greska u povezivanju sa bazom";
  exit;
  } 


  $upit = 'SELECT ime.svi_korisnici, prezime.svi_korisnici, tip_zaposlenja.svi_korisnici, ponedeljak.nacin_obavljanja, utorak.nacin_obavljanja, sreda.nacin_obavljanja  , cetvrtak.nacin_obavljanja, petak.nacin_obavljanja, subota.nacin_obavljanja, nedelja.nacin_obavljanja FROM svi_korisnici WHERE korisnicko.svi_korisnici == idKorisnika.nacin_obavljanja ';

  $pripremljena_naredba = $db->prepare($upit);
  $pripremljena_naredba->execute();
  $pripremljena_naredba->store_result();
  $pripremljena_naredba->bind_result($ime, $prezime, $tip_zaposlenja, $ponedeljak, $utorak, $sreda, $cetvrtak, $petak, $subota, $nedelja);



?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheet.css">
        <title>Kalendar</title>
    </head>
    <body>

      <div class="container">
                <!-- navbar meni-->
                <div id="myNav" class="overlayep">
                  <div id="botaomenu" class="botaomenu" onclick="myFunction(this); toggleNav()">
                  <div class="bar1"></div>
                  <div class="bar2"></div>
                  <div class="bar3"></div>
                </div>
                  <div class="overlay-content">
                    <ul class="menuList">
                      <?php  if (isset($_SESSION['korisnicko'])) : ?>
                      <li><a href="profil.php"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="icon bi bi-person-workspace" viewBox="0 0 16 16">
                      <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                      <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                    </svg>  Profil</a></li>
                    <?php endif ?>
                    <?php  if (isset($_SESSION['korisnicko'])) : ?> 
                      <li><a href="kalendar.php"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="icon bi bi-calendar-check" viewBox="0 0 16 16">
                      <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg> Kalendar</a></li>
                    <?php endif ?>

                      <li><a href="kalendar.php?logout='1'"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="icon bi bi-box-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg> Odjava</a></li> 

                    </ul>
                  </div> 
              </div>
            </div>
              <!--end of navbar html-->
           

       <!--page content start-->    
        <div class="container" id="main">
                 <div class="row">   
                    <div class="col">
                      <div class="divider"></div>
                      <div class="divider"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                     <div class="divider"></div>
                    </div>
                    <div class="col">
                    <div class="divider"></div>
                    </div>
                </div>

          <table>
                <div class="row justify-content-center">          
                            <tr>
                              <th>
                              </th>
                            </tr>
                            <tr>
                              <td>
                                PONEDELJAK
                              </td>
                              <td colspan="6">
                                <?php 
                                  while( $pripremljena_naredba->fetch() ) {
                                  echo "<tr>";
                                    echo "<td>$ime $prezime $tip_zaposlenja</td>";
                                  echo "</tr>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                UTORAK
                              </td>
                            </tr>
                            <tr>
                              <td>
                                SREDA
                              </td>
                            </tr>
                            <tr>
                              <td>
                                ČETVRTAK
                              </td>
                            </tr>
                            <tr>
                              <td>
                                PETAK
                              </td>
                            </tr>
                            <tr>
                              <td>
                                SUBOTA
                              </td>
                            </tr>
                            <tr>
                              <td>
                                NEDELJA
                              </td>
                            </tr>




                </div>
          </table>
                  </div>
                    

        </div>
    </div>

      
  </body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script src="script.js"></script>


</html>
