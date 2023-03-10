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


  $upit = 'SELECT ponedeljak, utorak, sreda, cetvrtak, petak, subota, nedelja FROM nacin_obavljanja WHERE idKorisnika= "'.$_SESSION['korisnicko'].'" ';

  $pripremljena_naredba = $db->prepare($upit);
  $pripremljena_naredba->execute();
  $pripremljena_naredba->store_result();
  $pripremljena_naredba->bind_result($ponedeljak, $utorak, $sreda, $cetvrtak, $petak, $subota, $nedelja);



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
            <?php 
              $pripremljena_naredba = $db->prepare($upit);
              $pripremljena_naredba->execute();
              $pripremljena_naredba->store_result();
              $pripremljena_naredba->bind_result($ponedeljak, $utorak, $sreda, $cetvrtak, $petak, $subota, $nedelja);
               while( $pripremljena_naredba->fetch() ) {
                
              ?>

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
                                PONEDELJAK
                              </th>
                              <th>
                                UTORAK
                              </th>
                              <th>
                                SREDA
                              </th>
                              <th>
                                ??ETVRTAK
                              </th>
                              <th>
                                PETAK
                              </th>
                              <th>
                                SUBOTA
                              </th>
                              <th>
                                NEDELJA
                              </th>
                            </tr>
                </div>
                <div class="row justify-content-center">
                            <tr class="">
                              <td>
                                <div class="divider"></div>
                                <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$ponedeljak"; ?> </b> <br><br><br></p>
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$utorak"; ?> </b> <br><br><br></p>
                                
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$sreda"; ?> </b> <br><br><br></p>
                               
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$cetvrtak"; ?> </b> <br><br><br></p>
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$petak"; ?> </b> <br><br><br></p>
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$subota"; ?> </b> <br><br><br></p>
                              </td>

                              <td>
                                <div class="divider"></div>
                                  <p class="infoStanje">
                                  Va?? odgovor je: <b> <?php echo "$nedelja"; ?> </b> <br><br><br></p>
                              </td>
                            </tr>
                      </div>
                      <div class="row justify-content-center">
                            <tr>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#ponedeljakCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table>
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1" >
                                        <div class="collapse" id="ponedeljakCollapse">
                                              <label for="" id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label>
                                        </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide">
                                                <tr>
                                                  <td id="">
                                              <div class="collapse" id="ponedeljakCollapse">
                                              <form method="POST" action="">  <!-- FORMA ponedeljak-->
                                                  <div class="row">
                                                      <input type="radio" name="ponedeljak" id="ponedeljakRadio" value="U kancelariji">
                                                      <label for="" id="labelRadio">U kancelariji</label>
                                                  </div>
                                                  <div class="row">
                                                      <input type="radio" name="ponedeljak" id="ponedeljakRadio" value="Sa daljine">
                                                      <label for="" id="labelRadio">Sa daljine</label>
                                                  </div>
                                                  <div class="row">
                                                      <input type="radio" name="ponedeljak" id="ponedeljakRadio" value="50/50">
                                                      <label for="" id="labelRadio">50/50</label>
                                                  </div>
                                                  <div class="row">
                                                      <button class="button" type="submit" name="obavljanjePoslaPonedeljak"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                    </svg> </button>
                                                  </div>
                                                </form>
                                              </div>
                                                  </td>
                                                </tr>
                                              
                                             </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>

                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p><button class="button" type="button" data-toggle="collapse" data-target="#utorakCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg> </button></p>
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="utorakCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="utorakCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="utorak" id="utorakRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="utorak" id="utorakRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="utorak" id="utorakRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaUtorak"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                              </svg> </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#sredaCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="sredaCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="sredaCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="sreda" id="sredaRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="sreda" id="sredaRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="sreda" id="sredaRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaSreda"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                              </svg>  </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#cetvrtakCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="cetvrtakCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="cetvrtakCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="cetvrtak" id="cetvrtakRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="cetvrtak" id="cetvrtakRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="cetvrtak" id="cetvrtakRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaCetvrtak"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                              </svg> </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#petakCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="petakCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="petakCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="petak" id="petakRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="petak" id="petakRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="petak" id="petakRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaPetak"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                              </svg> </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#subotaCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="subotaCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="subotaCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="subota" id="subotaRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="subota" id="subotaRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="subota" id="subotaRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaSubota"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                              </svg> </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>
                              <td class="align-baseline">  
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" id="filter"> <!--pocetak collapsible buttona-->
                                <p>
                                    <button class="button" type="button" data-toggle="collapse" data-target="#nedeljaCollapse" aria-expanded="false" aria-controls="collapseExample">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </button>
                                  </p>
                                
                                <table> <!-- ispis teksta u prozoru DAN -->
                                    <tbody>                   
                                        <tbody class="label">
                                          <tr>
                                            <td colspan="1"> <div class="collapse" id="nedeljaCollapse">
                                              <label for=""  id="filterTitle">Kako ??ete prisustvovati poslu ovog dana?</label> </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <div class="container">
                                          <tbody class="hide"> <tr> <td id="">
                                                  <div class="collapse" id="nedeljaCollapse">
                                                        <form method="POST" action=""> <!-- FORMA UTORAK-->
                                                            <div class="row">
                                                                <input type="radio" name="nedelja" id="nedeljaRadio" value="U kancelariji">
                                                                <label for="" id="labelRadio">U kancelariji</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="nedelja" id="nedeljaRadio" value="Sa daljine">
                                                                <label for="" id="labelRadio">Sa daljine</label>
                                                            </div>
                                                            <div class="row">
                                                                <input type="radio" name="nedelja" id="nedeljaRadio" value="50/50">
                                                                <label for="" id="labelRadio">50/50</label>
                                                            </div>
                                                            <div class="row">
                                                                <button  class="button" type="submit" name="obavljanjePoslaNedelja"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                              <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                            </svg> </button>
                                                            </div>
                                                          </form>
                                                  </div> 
                                                </td> </tr> </tbody>
                                            </div>
                                       </tbody> 
                                    </table>
                                </div> <!-- kraj collapsible buttona-->

                              </td>

                                
                                                  
                                                </tr>
                                              </div> <!-- kraj <div class="row justify-content-center">-->
                                              </form>
                                             </tbody>
                                            </div>
                                        
                                     </tbody> <!-- kraj navedenih filtera u tabeli filteri-->
                                  </table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>

                        </table>
                    </div>
                </div>

      
  </body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script src="script.js"></script>


</html>
