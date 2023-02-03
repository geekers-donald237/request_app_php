<?php 
    session_start();
    require '../config/config.php';
    require '../config/bd.php';

    $mat = $_SESSION['matricule'];
    //Recuperation des elemets de la requetes 
    $query1 = "SELECT * FROM `requete` WHERE Matricule LIKE '$mat' ORDER BY Daterequete DESC";
    $result1 = mysqli_query($conn,$query1);
	  $result1_tab = mysqli_fetch_all($result1,MYSQLI_ASSOC);

  
    if(isset($_POST['delete'])){
      $id = $_POST['delete'];
      // $_SESSION['id'] = $id;

      $query3 = "SELECT * FROM `requete` WHERE idRequete = $id";
      $result3 = mysqli_query($conn,$query3);
      $result3_tab = mysqli_fetch_assoc($result3);

      $objet = strval($result3_tab["objet"]);
      $libelle = strval($result3_tab["Libelle"]);
      $valider = intval($result3_tab["Valider"]);
      $remarque = strval($result3_tab["Remarque"]);
      $matricule = strval($result3_tab["Matricule"]);
      $codeue = strval($result3_tab["Codeue"]);
      $idens = intval($result3_tab["IdEnseignant"]);
      $piecesJointes = strval($result3_tab["PiecesJointes"]);
      $dateenvoi = date($result3_tab["Daterequete"]);
      $datereponse = date($result3_tab["DateReponse"]);
      
      // var_dump($result3_tab);

      $query4 = "INSERT INTO `corbeille`(`idRequeteC`, `objetC`, `LibelleC`, `ValiderC`, `RemarqueC`, `MatriculeC`, `CodeueC`, `idEnseignantC`, `DaterequeteC`,`DateSup`,`DateReponseC`, `PiecesJointesC`) 
        VALUES ('$id','$objet','$libelle','$valider','$remarque','$matricule','$codeue','$idens','$dateenvoi',current_timestamp(),'$datereponse','$piecesJointes')";
          $result4 = mysqli_query($conn,$query4);

     

      $query = "DELETE FROM `requete` WHERE idRequete = $id"; 
      $result = mysqli_query($conn,$query);
      header('Location:Dashboard.php');


     

     
    }

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
    <link rel="shortcut icon" href="../dist/assets/images/favicon.ico" />
</head>
<body>
    <div class="container-fluid mt-5">
       
          <div class="content-wrapper">
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                  <h4 class="page-title">Show All Ours Query</h4>
                </div>
                <form class="ml-auto search-form d-none d-md-block" action="#">
                  <div class="form-group p-3">
                    <input type="search" class="form-control" id="search" placeholder="Search Here With object" onkeyup="filtrer()">
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
                        <p>Bienvenue Mr | Mdlle <span class="text-prymary"></span> Nous vous proposons donc ici l'ensemble des requetes que vous avez effectue avec leurs etat d'avancement</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="border-spacing: 20px;">
                                    <tr>
                                    
                                    <th>objet</th>
                                    <th>Nom des Pieces Jointes</th>
                                    <th>UE</th>
                                    <th>Date d'envoie</th>
                                    <th>Date Renvoie</th>
                                    <th>Status</th>
                                    <th>Remarque</th>
                                    </tr> 	
                                </thead>
                                <tbody id="list" >
                                <?php 
                             
                                   foreach ($result1_tab as $value) {
                                         
                                        echo ' <tr>';
                                        echo '<td class="No">' . ($value['objet']) .'</td>';
                                        echo '<td>' . ($value['PiecesJointes']) .'</td>';
                                        echo '<td>' . ($value['Codeue']) .'</td>';
                                        echo '<td>' . ($value['Daterequete']) .'</td>';
                                        echo '<td>' . ($value['DateReponse']) .'</td>';
                                        echo '<td>';
                                        
                                        $valider = $value['Valider'];
                                        if($valider == 0){
                                            echo "<label class='badge bg-warning text-primary p-2'>ENVOYEE</label>";
                                          }else if($valider == 1){
                                            echo "<label class='badge bg-danger text-primary p-2'>VALIDEE</label>";
                                          }else{
                                            echo "<label class='badge bg-primary text-danger p-2'>REFUSEE</label>";
                                          }
                                        echo '</td>';
                                        echo '<td>' . ($value['Remarque']) .'</td>';
                                        if ($valider != 0) {
                                          echo ' <td> 
                                          <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
                                            <input type="hidden" name="delete" value="'.intval($value['idRequete']).'">
                                            <button type="submit" class="btn btn-muted"><i class="mdi mdi-delete text-danger" style="font-size: 20px;"></i></button>
                                          </form></td>';
                                        }else {
                                          echo '<td> </td>';
                                        }
                                        echo '</tr>'; 
                                        
                                        
                                  }
                                    ?>
                                    
                                </tbody>
                            </table>
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
    
        
    <script src="../dist/assets/js/search.js"></script>
    <script src="../dist/assets/vendors/js/vendor.bundle.base.js"></script> 
    <script src="../dist/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="../dist/assets/js/shared/misc.js"></script>
  </body>
</html>