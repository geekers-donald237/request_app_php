<?php 

    session_start();
    require '../config/config.php';
    require '../config/bd.php';

   
    
    
    if(isset($_POST['restaurer'])){
        $id =$_POST['restaurer'];

        $query = "SELECT * FROM `corbeille` WHERE id = $id ORDER BY DateRequeteC DESC";
        $result = mysqli_query($conn,$query);
        $result3_tab = mysqli_fetch_assoc($result);

        // var_dump($result3_tab);

        $objet = strval($result3_tab["objetC"]);
        $libelle = strval($result3_tab["LibelleC"]);
        $valider = intval($result3_tab["ValiderC"]);
        $remarque = strval($result3_tab["RemarqueC"]);
        $matricule = strval($result3_tab["MatriculeC"]);
        $codeue = strval($result3_tab["CodeueC"]);
        $idens = intval($result3_tab["idEnseignantC"]);
        $piecesJointes = strval($result3_tab["PiecesJointesC"]);
        $dateenvoi = date($result3_tab["DateRequeteC"]);
        $datereponse = date($result3_tab["DateReponseC"]);
  
        $query4 = "INSERT INTO `requete`(`idRequete`, `objet`, `Libelle`, `Valider`, `Remarque`, `Matricule`, `Codeue`, `idEnseignant`, `Daterequete`,`DateReponse`, `PiecesJointes`) 
          VALUES ('$id','$objet','$libelle','$valider','$remarque','$matricule','$codeue','$idens','$dateenvoi','$datereponse','$piecesJointes')";
            $result4 = mysqli_query($conn,$query4);
          

        $query5= "DELETE FROM `corbeille` WHERE id = $id"; 
        $result5 = mysqli_query($conn, $query5);
        header('Location:corbeille.php');   
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../dist/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../dist/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="../dist/assets/css/shared/style.css">
    <link rel="stylesheet" href="../dist/assets/css/demo_1/style.css">
    <title>Corbeille </title>
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
                     <p>Bienvenue , Ici sont stocké les  requetes qui ont ete supprimée pour  une durée de 15 jours</p>
                     <div class="table-responsive">
                         <table class="table table-striped table-hover">
                             <thead style="border-spacing: 20px;">
                                 <tr>
                                 
                                 <th>objet</th>
                                 <th>Nom des Pieces Jointes</th>
                                 <th>UE</th>
                                 <th>Date de suppression</th>
                                 <th>Status</th>
                                 <th>Remarque</th>
                                 <th>Restaurer</th>
                                 </tr> 	
                             </thead>
                             <tbody id="list" >
                             <?php 

                                $query1 = "SELECT * FROM `corbeille` ORDER BY DateRequeteC DESC";
                                $result1 = mysqli_query($conn,$query1);
                                $result31_tab = mysqli_fetch_all($result1,MYSQLI_ASSOC);


                          
                                foreach ($result31_tab as $value) {
                                      
                                     echo ' <tr>';
                                     echo '<td class="No">' . ($value['objetC']) .'</td>';
                                     echo '<td>' . ($value['PiecesJointesC']) .'</td>';
                                     echo '<td>' . ($value['CodeueC']) .'</td>';
                                     echo '<td>' . ($value['DateRequeteC']) .'</td>';
                                     echo '<td>';
                                     
                                     $valider = $value['ValiderC'];
                                     if($valider == 0){
                                         echo "<label class='badge bg-warning text-primary p-2'>ENVOYEE</label>";
                                       }else if($valider == 1){
                                         echo "<label class='badge bg-danger text-primary p-2'>VALIDEE</label>";
                                       }else{
                                         echo "<label class='badge bg-primary text-danger p-2'>REFUSEE</label>";
                                       }
                                     echo '</td>';
                                     echo '<td>' . ($value['RemarqueC']) .'</td>';
                                     if ($valider != 0) {
                                       echo ' <td> 
                                       <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
                                         <input type="hidden" name="restaurer" value="'.intval($value['id']).'">
                                         <button type="submit" class="btn btn-muted"><i class=" mdi mdi-cloud-sync text-dark" style="font-size: 20px;"></i></button>
                                       </form></td>';
                                     }else {
                                       echo '<td> </td>';
                                     }
                                     echo '</tr>';  
                               }

                               for ($i=0; $i < count($result31_tab) ; $i++) { 
                                    $date1 = new DateTime('now');
                                    $date2 = new DateTime($value['DateSup']);
                                    $a =$date2 -> diff($date1);
                                    
                                    if(((int)$a->format('%d')) >= 15){
                                        $query = "DELETE FROM `corbeille` WHERE id = $result31_tab[$i]['id'] ";
                                        $result = mysqli_query($conn , $query);
                                        header('Location:corbeille.php');
                                    }
                                    

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