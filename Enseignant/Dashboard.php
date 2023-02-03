<?php  

    session_start();
    require '../config/config.php';
	  require '../config/bd.php';


    $emailEnseignant  =  $_SESSION['usermail'];

    //Recuperation du nom de l'enseignant
    $query = "SELECT * FROM `enseignant` WHERE AdresseEmail like '$emailEnseignant'";
    $result  = mysqli_query($conn,$query);
    $result_tab = mysqli_fetch_assoc($result);
    $nomEnseignant = strval($result_tab['NomEnseignant']);
    $id = intval($result_tab['idEnseignant']);

    //Recuperation du code de l'UE
    $query2 = " SELECT * FROM `ue` WHERE idEnseignant = $id";
    $result2 = mysqli_query($conn,$query2);
    $result2_tab = mysqli_fetch_assoc($result2);
    $codeUE = strval($result2_tab['CodeUE']);


    //Recuperation de toute les requetes non traitees
    $query3 = "SELECT * FROM `requete` WHERE Idenseignant like '$id' AND Valider = 0 ORDER BY Daterequete DESC";
    $result3 = mysqli_query($conn,$query3);
    $result3_tab = mysqli_fetch_all($result3,MYSQLI_ASSOC);
    $nbRequetesNonTraitees = count($result3_tab);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel Teachers Dashboard</title>
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../dist/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="../dist/assets/css/shared/style.css">
    <link rel="stylesheet" href="../dist/assets/css/demo_1/style.css">
</head>
<body>
  
    <div class="container-scroller " >
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="./Dashboard.php">
            <img src="../dist/assets/img/logo/logo.png" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="./Dashboard.php">
            <img src=../dist/assets/img/logo/logo.png" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +(237) 222 23 44 96 | doyen@facsciences.uy1.cm</li>
            
          </ul>
          <form class="ml-auto search-form d-none d-md-block" action="#">
            <div class="form-group">
              <input type="search" id="search" class="form-control" placeholder="Search Here With name" onkeyup="filtrer()">
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline" title="vous Avez <?php echo $nbRequetesNonTraitees ?> requetes non traitees"></i>
                <span class="count"><?php  echo $nbRequetesNonTraitees ?></span>
              </a>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../dist/assets/images/avatar2.png" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../dist/assets/images/avatar2.png" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $nomEnseignant ?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $emailEnseignant ?></p>
                </div>
                <a href="./profile.php" class="dropdown-item">My Profile <i class="dropdown-item-icon ti-dashboard"></i></a>
                <a  class="dropdown-item">Notifications<span class="badge badge-pill badge-danger"><?php echo $nbRequetesNonTraitees ;?></span><i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a href="./deconnexion.php" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
          
        </div>
      </nav>
     

      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas pt-3" id="sidebar">
          <ul class="nav ">
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="./Dashboard.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title"> Teachers Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Operations | Requetes </span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="./ShowAll.php">Consulter les requetes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Repondre aux Requetes</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Others Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="Login.php"> Login </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../index.php"> Home </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
       

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                  <h4 class="page-title">Dashboard</h4>
                </div>
              </div>
            </div>
           
            <div class="row col-md-15 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="card-title mb-0 text-primary">Requetes</h4>
                            <a href="./ShowAll.php"><small>Show All</small></a>
                        </div>
                        <?php 

                        if($nbRequetesNonTraitees == 0){
                            echo "<p>Bienvenue Mr | Mlle <span class='text-primary'> $nomEnseignant </span> 
                              Vous n'avez recu aucune nouvelle requete</p>";
                        }else {
                            echo "<p>Bienvenue Mr | Mlle <span class='text-primary'>$nomEnseignant </span> Nous vous 
                              proposons une vue d'ensemble sur vos  dernieres requetes non traitees</p>";
                            echo '<div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="border-spacing: 20px;">
                                <tr>
                            <th>Nom & Prenom</th>
                            <th>Matricule</th>
                            <th>objet</th>
                            <th>UE</th>
                            <th>Nom des Pieces Jointes</th>
                            <th >Date denvoie</th>
                            </tr> 	
                        </thead>
                        <tbody  id = "list">';
                          $count =0;
                          
                            for($i=0; $i<count($result3_tab); $i++) { 
                              $mat = $result3_tab[$i]['Matricule'];
                                //recuperation du nom et du prenom 
                              $query4 = "SELECT * FROM `etudiant` WHERE Matricule LIKE '$mat' ";
                              $result4 = mysqli_query($conn,$query4);
                              $result4_tab = mysqli_fetch_assoc($result4);
                              $nomcomplet = ($result4_tab['NomEtudiant']) . "  " .($result4_tab['PrenomEtudiant']);
                              echo ' <tr>';
                              echo '<td class = "No"> '.  $nomcomplet .'</td>';
                              echo '<td>' . ($result3_tab[$i]['Matricule']) .'</td>';
                              echo '<td >' . ($result3_tab[$i]['objet']) .'</td>';
                              echo '<td >' . ($result3_tab[$i]['Codeue']) .'</td>';
                              echo '<td>' . ($result3_tab[$i]['PiecesJointes']) .'</td>';
                              echo '<td>' . ($result3_tab[$i]['Daterequete']) .'</td>';
                              echo '</tr>'; 
                              $count ++;

                              if($count == 5){
                                break;
                              }
                            }
                              
                        echo '  </tbody>
                      </table><br>
                        </div>';
                   
                    } 
                    ?>
                     </div>
                </div>
            </div>            

                
              
            </div>

           
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © ICTL2 - UY1</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Follow Me on the Social media <a href="https://github.com/geekers-donald237" target="_blank">Github.</a> Query-App-Project from ICTL2 Student's</span>
            </div>
          </footer>
        </div>
    </div> 
   
    <script src="../dist/assets/js/search.js"></script>
    <script src="../dist/assets/vendors/js/vendor.bundle.base.js"></script> 
    <script src="../dist/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="../dist/assets/js/shared/misc.js"></script>
    
    <script src="../dist/assets/js/shared/off-canvas.js"></script>
    <script src="../dist/assets/js/shared/misc.js"></script>
    <script src="../dist/assets/js/demo_1/dashboard.js"></script>
    </body>
</html>