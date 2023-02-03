<?php  

  session_start();
  require '../config/config.php';
	require '../config/bd.php';

  //Recuperation du matricule
  $mat = $_SESSION['matricule'];
  //query
  $query = " SELECT * FROM `etudiant` WHERE Matricule like '$mat'";
  $result = mysqli_query($conn,$query);
  $result_tab = mysqli_fetch_assoc($result);
  $nom = strval($result_tab['NomEtudiant']);
  $_SESSION['nom'] = $nom;
  $idniveau = intval($result_tab['Idniveau']);
  $_SESSION['idniveau'] = $idniveau;

  
  $query11 = "SELECT * FROM `corbeille`";
  $result11 = mysqli_query($conn,$query11);
  $result11_tab = mysqli_fetch_all($result11,MYSQLI_ASSOC);
  $corb = count($result11_tab);



  //Recuperation des elemets de la requetes 
  $query2 = "SELECT * FROM `requete` WHERE Matricule LIKE '$mat' ORDER BY Daterequete DESC";
  $result2 = mysqli_query($conn,$query2);
	$result2_tab = mysqli_fetch_all($result2,MYSQLI_ASSOC);
  $nb = count($result2_tab);
  
  //recuperation des requetes non validees 
  $query3 = "SELECT * FROM `requete` WHERE (Valider = -1) and (Matricule like '$mat')";
  $result3 = mysqli_query($conn,$query3);
	$result3_tab = mysqli_fetch_all($result3,MYSQLI_ASSOC);


  //recuperation des requetes validees
  $query4 = "SELECT * FROM `requete` WHERE (Valider = 1) and (Matricule like '$mat')";
  $result4 = mysqli_query($conn,$query4);
	$result4_tab = mysqli_fetch_all($result4,MYSQLI_ASSOC);


  //recuperation du nombre de requtes validees pour un utilisateur;
  $nbvalidees = count($result4_tab);


  //recuperation du nombre de requtes non validees pour un utilisateur;
  $nbinvalidees = count($result3_tab);
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel Students Dashboard</title>
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
            <img src="../dist/assets/img/logo/logo.png" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +(237) 222 23 44 96 | doyen@facsciences.uy1.cm</li>
            
          </ul>
          <form class="ml-auto search-form d-none d-md-block" action="#">
            <div class="form-group">
              <input type="search" class="form-control" id="search" placeholder="Search Here With object" onkeyup="filtrer()">
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false" title="<?php echo 'Vous Avez '.$nbvalidees .' Requetes Validees';?>">
                <i class="mdi mdi-check"></i>
                <span class="count"><?php  echo $nbvalidees ;?></span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown" title="<?php echo 'Vous Avez '.$nbinvalidees .' Requetes Rejetee'?>">
                <i class="mdi mdi-delete"></i>
                <span class="count bg-success"><?php echo $nbinvalidees ?></span>
              </a>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../dist/assets/images/avatar.webp" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../dist/assets/images/avatar.webp" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['matricule'] ?></p>
                  <p class="font-weight-light text-muted mb-0"><?php  echo $nom  ?></p>
                </div>
                <a href="./profile.php" class="dropdown-item">My Profile<i class="dropdown-item-icon ti-dashboard"></i></a>
                <a href="./deconnexion.php" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                <a href="./corbeille.php" class="dropdown-item">Recycle bin <span class="badge badge-pill badge-danger"><?php echo $corb ?></span><i class="dropdown-item-icon ti-dashboard"></i></a>
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
                <span class="menu-title">Dashboard</span>
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
                    <a class="nav-link" href="./modifRequete.php">Modifier les requetes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./Requete.php">Creation d'une nouvelles requetes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./showAll.php">Afficher Toutes Les requetes</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="Login.php"> Login </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Register.php"> Register </a>
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
                            <a href="./showAll.php"><small>Show All</small></a>
                        </div>

                        <?php 
                        if(($nb == 0)){
                            echo "<p>Bienvenue Mr | Mdlle <span class='text-primary'> $nom </span>
                              Vous n'avez encore effectuer aucune requete !.  Pourquoi ne pas <a href='./Requete.php'>commencer maintenant ??</a>  </p>";
                        }else 
                        {
                          echo "<p>Bienvenue Mr | Mdlle <span class='text-primary'> $nom </span>
                            Nous vous proposons une vue d'ensemble de quelques requetes que vous avez effectue</p>";
                          echo 
                              "<div class='table-responsive'>
                              <table class='table table-striped table-hover'>
                                <thead style='border-spacing: 20px;'>
                                    <tr>
                                    <th>objet</th>
                                    <th>Nom des Pieces Jointes</th>
                                    <th>UE</th>
                                    <th>Date d'envoie</th>
                                    </tr> 	
                                </thead>
                                <tbody id = 'list'>";
                                    
                                    $count = 0;
                                   foreach ($result2_tab as $value) {
                                    echo ' <tr>';
                                    echo '<td  class="No" >' . ($value['objet']) .'</td>';
                                    echo '<td>' . ($value['PiecesJointes']) .'</td>';
                                    echo '<td>' . ($value['Codeue']) .'</td>';
                                    echo '<td>' . ($value['Daterequete']) .'</td>';
                                    echo '</tr>';  
                                    $count ++;
                                        if($count == 5){
                                          break;
                                        } 
                                  }
                                    
                                    
                                echo' </tbody>
                            </table>
                        </div>';
                      }
                      ?>
                    </div>
                </div>
            </div>            

            <div class='row'>
              <div class='col-md-6 grid-margin stretch-card'>
                <div class='card'>
                  <div class='card-body'>
                    <h4 class='card-title mb-0 text-primary'>Requetes  validees</h4>
                    <div class='d-flex py-2  mb-3'>
                        <div class='wrapper'>
                          <p class='font-weight-semibold text-gray mb-0'>Objet</p>
                        </div>
                        <small class=' ml-auto '>UE</small>
                    </div>

                    <?php       
                    $count = 0;
                     foreach ($result4_tab as $value) { 
                        echo '<div class="d-flex py-2 border-bottom">';
                        echo '<div class="wrapper">';
                        echo "  <p class='font-weight-semibold text-gray mb-0'>".$value['objet']."</p>";
                        echo '</div>';
                        echo "<small class=' ml-auto'>".$value['Codeue']."</small>";
                        echo ' </div>';
                        $count ++;
                      if($count == 5){
                        break;
                      } 
                      }
                      
                    ?>
                  
                  </div>
                </div>
              </div>
            
                
                    
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <h4 class="card-title mb-0 text-primary">Requetes non validees</h4>
                    <div class="d-flex py-2  mb-3">
                        <div class="wrapper">
                          <p class="font-weight-semibold text-gray mb-0">Objet</p>
                        </div>
                        <small class=" ml-auto ">UE</small>
                    </div>

                    <?php      
                    $count =0; 
                     foreach ($result3_tab as $value) { 
                        echo '<div class="d-flex py-2 border-bottom">';
                        echo '<div class="wrapper">';
                        echo "  <p class='font-weight-semibold text-gray mb-0'>".$value['objet']."</p>";
                        echo '</div>';
                        echo "<small class=' ml-auto'>".$value['Codeue']."</small>";
                        echo ' </div>';
                        $count ++;
                        if($count == 5){
                          break;
                        } 
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