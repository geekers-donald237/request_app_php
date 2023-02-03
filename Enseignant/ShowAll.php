<?php 

    session_start();
    require '../config/config.php';
    require '../config/bd.php';

    if(isset($_POST['voir'])){
      $id = $_POST['voir'];
      $_SESSION['id'] = $id;
      header('Location:Response.php');
    }
    
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


    //Recuperation de toute les requetes effectues 
    $query3 = "SELECT * FROM `requete` WHERE Idenseignant like '$id' AND Valider = 0 ORDER BY Daterequete DESC";
    $result3 = mysqli_query($conn,$query3);
    $result3_tab = mysqli_fetch_all($result3,MYSQLI_ASSOC);
    


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
    <link rel="shortcut icon" href="../dist/assets/images/favicon.ico" />
  </head>
<body>
  
     <div class="container-fluid mt-5 mb-5">
          <div class="content-wrapper">
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                  <h4 class="page-title">Show All Ours Query</h4>
                </div>
                <form class="ml-auto search-form d-none d-md-block" action="#">
                  <div class="form-group">
                    <input type="search" id="search" class="form-control" placeholder="Search Here With name" onkeyup="filtrer()">
                  </div>
                </form>
              </div>
            </div>
           
            <div class="row col-md-15 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="card-title mb-0 text-primary">Requetes</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover p-3 my-3" >
                                <thead>
                                    <tr>
                                    <th>Nom & Prenom</th>
                                    <th>Matricule</th>
                                    <th>Objet</th>
                                    <th>UE</th>
                                    <th>Date d'envoie</th>
                                    <th>Pieces jointes</th>
                                    <th>Repondre</th>
                                    </tr> 	
                                </thead>
                                <tbody id="list">
                                <?php 
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
                                   echo '<td>' . ($result3_tab[$i]['Daterequete']) .'</td>';
                                  echo '<td>' . ($result3_tab[$i]['PiecesJointes']) .'</td>';
                                  echo ' <td> 
                                            <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
                                              <input type="hidden" name="voir" value="'.$result3_tab[$i]['idRequete'].'">
                                              <button type="submit" class="btn btn-primary">Repondre</button>
                                            </form></td>';
                                    echo '</tr>'; 

                                  }
                                    ?>
                                </tbody>
                            </table><br>
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

    <script src="../dist/js/search.js"></script>
    <script src="../dist/assets/vendors/js/vendor.bundle.base.js"></script> 
    <script src="../dist/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="../dist/assets/js/shared/misc.js"></script>
  </body>
</html>