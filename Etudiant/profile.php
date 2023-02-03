<?php 

    session_start();
    require '../config/config.php';
    require '../config/bd.php';


    $mat = $_SESSION['matricule'];
    $query = " SELECT * FROM `etudiant` WHERE Matricule like '$mat'";
    $result = mysqli_query($conn,$query);
    $result_tab = mysqli_fetch_assoc($result);
    $nom = strval($result_tab['NomEtudiant']);
    $prenom= strval($result_tab['PrenomEtudiant']);
    $email = strval($result_tab['AdresseEmailEtudiant']);
    $idniveau = intval($result_tab['Idniveau']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Modifier Profil</title>
</head>
<body>
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="./index.php">Home</a></li>
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="./Dashboard.php">User Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt nihil asperiores itaque architecto, sint dolore laborum deserunt, nobis possimus earum sit doloribus unde?</p>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="../dist/assets/images/avatar.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo $mat ; ?></h5>
            <p class="text-muted mb-1"><?php echo $nom . " " .$prenom ?></p>
            <p class="text-muted mb-4"><?php echo $email ;?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">First Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $nom ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Sur Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $prenom ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $email ;?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Filiere</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">UY1 - FS - ICT4D</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Niveau</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php 
                    if($idniveau == 1){ 
                        echo 'Licence 1';
                        $_SESSION['level'] = 'Licence 1';
                    }else if($idniveau == 2){ 
                        echo 'Licence 2';   
                        $_SESSION['level'] = 'Licence 2'; 
                    }else if($idniveau == 3){ 
                        echo 'Licence 3';    
                        $_SESSION['level'] = 'Licence 3';
                    }else if($idniveau == 4){ 
                        echo 'Master I Pro';   
                        $_SESSION['level'] = 'Master I Pro';     
                    }else { 
                        echo 'Master II Pro';    
                        $_SESSION['level'] = 'Master II Pro';}
                ?></p>
              </div>
            </div><hr>
          </div>
        </div>
      </div>
      <a href="./modifprofil.php"><button type="button" class="btn btn-primary">Modifier mon Profil</button></a>
    </div>
  </div>
    <footer aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 footer">
        <div class="container">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © ICTL2 - UY1</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Follow Me on the Social media <a href="https://github.com/geekers-donald237" target="_blank">Github.</a> Query-App-Project from ICTL2 Student's</span>
        </div>
    </footer>
</section>
</body>
</html>