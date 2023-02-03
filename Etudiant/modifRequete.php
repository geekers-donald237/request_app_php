<?php 
    session_start();
    require '../config/config.php';
    require '../config/bd.php';

    if(isset($_POST['voir'])){
        $id = $_POST['voir'];
        $_SESSION['id'] = $id;
        header('Location:NewRequete.php');
      }
      

    $mat = $_SESSION['matricule'];
    //Recuperation des elemets de la requetes 
     $query1 = "SELECT * FROM `requete` WHERE Matricule LIKE '$mat' and Valider = -1 ORDER BY DateReponse DESC";
    $result1 = mysqli_query($conn,$query1);
	$result1_tab = mysqli_fetch_all($result1,MYSQLI_ASSOC);

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
                  <h4 class="page-title">Modify Ours Query</h4>
                </div>
              </div>
            </div>
           
            <div class="row col-md-15 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="card-title mb-0 text-primary">Requetes</h4>
                        </div>
                        <p>Nous vous proposons donc ici toute les requtes qui 
                            ont ete invalidees , vous avez donc la possibilite de les modifier et de directement les renvoyer a l'ensignant concerne.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="border-spacing: 20px;">
                                    <tr>
                                    
                                    <th>objet</th>
                                    <th>UE</th>
                                    <th>Nom des Pieces Jointes</th>
                                    <th>Date de Reponse</th>
                                    <th>Remarque</th>
                                    <th></th>
                                    </tr> 	
                                </thead>
                                <tbody>
                                <?php 
                             
                                   foreach ($result1_tab as $value) {
                                         
                                        echo ' <tr>';
                                        echo '<td>' . ($value['objet']) .'</td>';
                                        echo '<td>' . ($value['Codeue']) .'</td>';
                                        echo '<td>' . ($value['PiecesJointes']) .'</td>';
                                        echo '<td>' . ($value['DateReponse']) .'</td>';
                                        echo '<td>' . ($value['Remarque']) .'</td>';
                                        echo ' <td> 
                                        <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
                                          <input type="hidden" name="voir" value="'.intval($value['idRequete']).'">
                                          <button type="submit" class="btn btn-primary">Modifier</button>
                                        </form></td>';
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
    <script src="../dist/assets/vendors/js/vendor.bundle.base.js"></script> 
    <script src="../dist/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="../dist/assets/js/shared/misc.js"></script>
  </body>
</html>