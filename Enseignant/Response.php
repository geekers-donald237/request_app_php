<?php 

    session_start();
    require '../config/config.php';
    require '../config/bd.php';
    require_once("./config.php");
    $id = $_SESSION['id'];

	

	//Message Vars
	$msg = '';
	$msgClass = '';
	

	//Check for submit
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$dec =test_input($_POST['descision']);
		$remarque = test_input($_POST['remarque']); 
		
		

		//VAlidation 
		if(strcmp($dec , "Je Valide la Requete") == 0){

			$query1 = "UPDATE `requete` SET `Valider`= '1',`Remarque`=' ',
				`DateReponse`=current_timestamp()
				 WHERE idRequete = $id";
			$result1 = mysqli_query($conn,$query1);

			session_start();
			header('Location:Dashboard.php');

		}else if((strcasecmp($dec,"Je rejete la Requete") == 0) && !empty($remarque)){
			
			// $remarque = mysqli_real_escape_string($conn,$remarque);
			//create a query
			$query3 = "UPDATE `requete` SET `Valider`= '-1',`Remarque`='$remarque'
				,`DateReponse`=current_timestamp()  WHERE idRequete = $id";
			$result3 = mysqli_query($conn,$query3);
			header('Location:Dashboard.php');
		}else {
			$msg = 'Please fill all the fields';
			$msgClass = 'alert-danger';
		}
			// session_start();
			// header('Location : Dashboard.php');
	
	}
 



    //Selection de tout les elements 
    $query = "SELECT * FROM `requete` WHERE idRequete = $id";
    $result  = mysqli_query($conn,$query);
    $result_tab = mysqli_fetch_assoc($result);
    $mat = strval($result_tab['Matricule']);
    

    // Recupereation du matricule  
    $query2 = "SELECT * FROM `etudiant` WHERE Matricule LIKE '$mat' ";
    $result2 = mysqli_query($conn,$query2);
    $result2_tab = mysqli_fetch_assoc($result2);

	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Answers of Query</title>
		<meta name="description" content="Demo for the tutorial: Styling and Customizing File Inputs the Smart Way" />
		<meta name="keywords" content="cutom file input, styling, label, cross-browser, accessible, input type file" />
		<meta name="author" content="Osvaldas Valutis for Codrops" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>   
        <link rel="stylesheet" type="text/css" href="../dist/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="../dist/assets/css/style2.css"/>
		<link rel="stylesheet" type="text/css" href="../dist/assets/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../dist/assets/css/component.css" />
		
	</head>
	<body>
	 <div class="page-content">
		<div class="form-v10-content">
		<?php if($msg != '') :?>
                <div class="alert <?php echo $msgClass?>">
                    <?php echo $msg; ?>
                </div>
            <?php endif;?>
			<form class="form-detail" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="myform" enctype="multipart/form-data">
				<div class="form-left mt-5">
					<h2>Show a Complete Request</h2>
					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="full_name" id="full_name" disabled value="<?php echo 'nom : '.$result2_tab['NomEtudiant']."  ".$result2_tab['PrenomEtudiant'] ?>">
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="matricule" id="matricule" class="input-text" disabled value="<?php echo 'matricule : '. $mat; ?>">
						</div>
					</div>
					
					<div class="form-row">
						<input type="text" name="object" id="object" class="object"  disabled value="<?php echo 'objet  : '.$result_tab['objet']; ?>">
					</div>
					<div class="form-row">
						<textarea class="form-control form-control-lg" id="libelle" name="libelle" disabled rows="10" cols="130" placeholder="Corps de la requête" pattern="[0-9]" required >
                            <?php 
                                echo $result_tab['Libelle'];
                            ?>
						</textarea>
					</div>	
					
					<div class="form-row d-flex justify-content-center align-items-center">
						<a href="<?php echo "download.php?id='$id'"; ?>"><button type="button" class="btn btn-primary" style="width: 60vh; height:10vh; " >Voir la Pieces Jointes</button></a>
                   </div>
					<div class="form-row form-row-3">
						<select class="form-select form-control-lg dec" required  name="descision">
							<option  selected disabled value=" Valider Vous La Requete ?">Valider Vous La Requete ?</option>
							<option  value="Je Valide la Requete">OUI ! je valide</option>
							<option  value="Je rejete la Requete">NON ! je rejete</option>
						</select>
						<span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>
			
					<div class="form-row" id="remarque" style="display: none;">
						<label for="Remarque" class="text-secondary col-form-label pb-2">Remarque<i class="input-helper"></i></label>
						<textarea class="form-control form-control-lg"  name="remarque"  rows="10" cols="130" placeholder="Remarques" pattern="[0-9]" required value = " ">
							 
						</textarea>
					</div>	

					<div class="form-row d-flex justify-content-center align-items-center">
						<button type="submit" class="btn btn-primary" style="width: 60vh; height:10vh; " >Envoyez la Reponse</button>

					</div> 
				</div>
			</form> 
		</div>
	</div>
	

		<div class="result" style="display: none;"></div>
		<script src="../dist/assets/js/Response.js"></script>
	</body>
</html>
