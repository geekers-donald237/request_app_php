<?php  
    
    require '../config/config.php';
	require '../config/bd.php';
	require_once("config.php");

	session_start();
	$id = $_SESSION['id'];
  
	$query = "SELECT * FROM `requete` WHERE idRequete = $id";
	$result = mysqli_query($conn,$query);
	$result_tab = mysqli_fetch_assoc($result);
	$ue = strval($result_tab['Codeue']);
	$text = strval($result_tab['Libelle']);

	//Selection des UEs
	$query1 = "SELECT CodeUE FROM ue WHERE idNiveau = $id";
	$result1 = mysqli_query($conn,$query1);
	$result1_tab = mysqli_fetch_all($result1,MYSQLI_ASSOC);


	//Recuperation de l'id du prof
	$query2 = "SELECT idEnseignant FROM ue WHERE CodeUE LIKE '$ue'";
	$result2 = mysqli_query($conn,$query2);
	$result2_tab = mysqli_fetch_assoc($result2);
	$idEnseignant = intval($result2_tab['idEnseignant']);


	//Recuperation du nom du professeur 
	$query3 = "SELECT NomEnseignant FROM enseignant WHERE idEnseignant LIKE '$idEnseignant'";
	$result3  = mysqli_query($conn,$query3);
	$result3_tab = mysqli_fetch_assoc($result3);
	$nomEnseignant = strval($result3_tab['NomEnseignant']);
		

	//Validation du formulaire 
    //Message Vars
    $msg = '';
    $msgClass = '';	

	
	//Create query 
	if(isset($_POST['form_submit'])){		
		$textarea = test_input($_POST['libelle']);
		if(!empty($textarea)){
			$textarea = mysqli_real_escape_string($conn,$textarea);
			// if(strcasecmp($text,$textarea)){
			// 	$msg = 'Veuillez Remplir des informations diferentes de la requettes precedentes';
			// 	$msgClass = 'alert-warning';	
			// }else
			{

				
				$folder = "../Enseignant/uploads/";
				$image_file=$_FILES['image']['name'];
				$file = $_FILES['image']['tmp_name'];
				$path = $folder . $image_file;  
				$target_file=$folder.basename($image_file);
				$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
		
				//Allow only JPG, JPEG, PNG & GIF etc formats
				if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" ) {
					$error[] = 'Sorry, only PDF, DOCX, DOC & TXT files are allowed';   
				}
		
				//Set image upload size 
				if ($_FILES["image"]["size"] > 1500000) {
				$error[] = 'Sorry, your file is too large. Upload less than 500 MO in size.';
				}

				$matricule = $_SESSION['matricule'];
				$query = "UPDATE `requete` SET `Libelle`='$textarea',`Valider`=0,`Remarque`='Nothing',`Daterequete`=current_timestamp(),`PiecesJointes`='$image_file' 
					WHERE idRequete = $id";
				$result = mysqli_query($conn,$query);

				$msg = 'Youpi Your Request has benn modify successfully';
				$msgClass = 'alert-success';	
				header('Location:Dashboard.php');
			}
		}else {
			//Failed
			$msg = 'Please fill in all fields ';
			$msgClass = 'alert-danger';
		}
	}









	
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
		<title>Create New Query</title>
		<meta name="description" content="Demo for the tutorial: Styling and Customizing File Inputs the Smart Way" />
		<meta name="keywords" content="cutom file input, styling, label, cross-browser, accessible, input type file" />
		<meta name="author" content="Osvaldas Valutis for Codrops" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
			integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../dist/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="../dist/assets/css/style2.css"/>
		<link rel="stylesheet" type="text/css" href="../dist/assets/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../dist/assets/css/component.css" />
		
		<script>
			(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
		</script>
	</head>
	<body>
	<?php if($msg != '') :?>
		<div class="alert <?php echo $msgClass?>">
			<?php echo $msg; ?>
		</div>
	<?php endif;?>
	<div class="page-content">
		<div class="form-v10-content">
			<form class="form-detail" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="myform" enctype="multipart/form-data">
				<div class="form-left mt-5">
					<h2>Create New Request</h2>
					 <div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="full_name" id="full_name" class="input-text" 
							value="<?php echo $_SESSION['nom']  ?>" disabled>
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="matricule" disabled 
							value="<?php echo $_SESSION['matricule']; ?>"
							id="matricule" class="input-text"  >
						</div>
					</div>
					
					<div class="form-row">
						<input type="text" name="object" id="object" class="object" 
							value="<?php echo  strval($result_tab['objet']);?>"
						disabled>
					</div>
					<div class="form-row form-row">
						<select class="form-select form-control-lg" id="selectlevel"  name="ue">
							<option selected disabled value="<?php echo $ue;?>"><?php echo $ue;?></option>
						</select>
					</div>
					<div class="form-row">
						<input type="text" name="prof_name" id="prof_name" class="input-text"  disabled value="<?php echo $nomEnseignant;?>">
					</div> 

					<div class="form-row">
						<label for="libelle" class="text-secondary col-form-label pb-2">Libellé<i class="input-helper"></i></label>
						<textarea class="form-control form-control-lg" id="libelle" name="libelle" rows="10" cols="130" placeholder="Corps de la requête" pattern="[0-9]" required >
							<?php
								echo  strval($result_tab['Libelle']);
							?>  
						</textarea>
					</div>

					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="file" required name="image" id="file-2" class="inputfile inputfile-2" style="width: 100vh;"  data-multiple-caption="{count} files selected" multiple />
							<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Pieces Jointes&hellip;</span></label>
						</div>
						<div class="form-row form-row-2">
							<button type="submit" name="form_submit" class="btn btn-primary align-items-center " style="width: 100vh;">Re-envoyer</button>
						</div> 
					</div>			
				</div>
			</form>
		</div>
	</div>
	<script src="../dist/js/custom-file-input.js"></script>
	</body>
</html>
