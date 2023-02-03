<?php 

    session_start();
    require '../config/config.php';
    require '../config/bd.php';

    //Message Vars
    $msg = '';
    $msgClass = '';

    //Check for submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = test_input($_POST['name']);
        $surname = test_input($_POST['surname']);
        $matricule = test_input($_POST['matricule']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $confirm_pw = test_input($_POST['confirm_pw']);
        $filiere = $_POST['filiere'];
        $niveau = $_POST['niveau'];

        

        //Validation
        if (!empty($name) && !empty($surname) && !empty($matricule) 
        && !empty($email)&& !empty($password) && !empty($confirm_pw)
        && !empty($niveau) && !empty($filiere)){
            //Passed
                //test name
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $msg = "Only letters and white space allowed";
                    $msgClass = 'alert-danger';
                }
                //test email
                if (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
                    //failed
                    $msg = 'Please use a valid email';
                    $msgClass = 'alert-danger';
                } else {
                    try {
                    
                        //test password
                        if ($password != $confirm_pw) {
                            $msg = 'Please confirm Your Password';
                            $msgClass = 'alert-danger';
                        }else {
                             //tout est correct

                            $name = mysqli_real_escape_string($conn,$name);
                            $surname = mysqli_real_escape_string($conn,$surname);
                            $matricule = mysqli_real_escape_string($conn,$matricule);
                            $email = mysqli_real_escape_string($conn,$email);
                            $password = mysqli_real_escape_string($conn,$password);
                            $filiere = mysqli_real_escape_string($conn , $filiere);

                            //create query
                            $query1 = 'SELECT Matricule FROM `etudiant`';
                            $query2 = "SELECT idNiveau FROM `niveau` WHERE  NomNiveau LIKE '$niveau'"; 

                           
                            //get result
                            $result1 = mysqli_query($conn,$query1);
                            $result2 = mysqli_query($conn , $query2);
                            $id = mysqli_fetch_assoc($result2);

                            $id = intval($id['idNiveau']);
                            //fetch data
                            $matricules = mysqli_fetch_all($result1,MYSQLI_ASSOC);
                            mysqli_free_result($result1);

                            if (count($matricules) == 0) {
                                // echo 'cas 1';
                                //new user
                                $query = "INSERT INTO `etudiant`(`Matricule`, `NomEtudiant`, `PrenomEtudiant`, `MdpEtudiant`, `AdresseEmailEtudiant`, `Idniveau`) 
                                    VALUES ('$matricule','$name','$surname','$password','$email','$id')";
                                addUser($conn,$query,$msg,$msgClass);

                                //Creation de compte
                                
                                
                            } else {

                                // echo 'cas 2';
                                foreach ($matricules as $mail) {
                                
                                    if ($matricule == $mail['Matricule']) {
                                        //old user
                                        $msg = 'User Already in Database';
                                        $msgClass = 'alert-danger';
                                    } 
                                    else {
                                        //new user
                                        $query = "INSERT INTO `etudiant`(`Matricule`, `NomEtudiant`, `PrenomEtudiant`, `MdpEtudiant`, `AdresseEmailEtudiant`, `Idniveau`) 
                                    VALUES ('$matricule','$name','$surname','$password','$email','$id')";
                                        addUser($conn,$query,$msg,$msgClass);
                                        
                                    }
                                    break;
                                }
                            }
                            

                        }

                    }catch (mysqli_sql_exception $th) {
                        $msg = "Il semblerait que vous etes deja inscrit avec votre matricule , Veuillez reessayer avec un autre !!";
                        $msgClass = 'alert-warning';
                        
                 }
            } 
                
        } else {
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

    

    function addUser($conn,$query,&$msg,&$msgClass) {
        //new user
        if (mysqli_query($conn,$query)) {
            $msg = 'Youpi your are register';
            $msgClass = 'alert-success';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous"> -->

</head>
<body  class="login">
    <section class="p-5  rounded h-100 ">
        <div class="container h-100 rounded">
            <?php  if($msg != '') :?>
                <div class="alert <?php echo $msgClass?>">
                    <?php echo $msg; ?>
                </div>
            <?php endif;?>
            <div class="row h-100 justify-content-between align-items-center g-4">
                <div class="col-lg-6 col-md d-none d-md-block order-2">
                    <img src="../dist/assets/img/20220812_142234.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md bg-light shadow border">
                    <div class="h3 text-center text-primary my-3 text-uppercase">Register For Student's</div>
                    <form class="p-3" method ="post" 
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                        <div class="form-group mb-2">
                          <label for="validationCustom01" class="form-label">Name</label>
                          <input type="text" class="form-control" name="name" id="name" 
                          value="<?php echo isset($_POST['name']) ? $name : '' ;?>" placeholder="Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" name="surname" id="surname" 
                            value="<?php echo isset($_POST['surname']) ? $surname : '' ;?>" placeholder="Surname" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="surname">Matricule</label>
                            <input type="text" class="form-control" name="matricule" id="matricule" 
                            value="<?php echo isset($_POST['matricule']) ? $matricule : '' ;?>" placeholder="Matricule" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" 
                            value="<?php echo isset($_POST['email']) ? $email : '' ;?>" placeholder="Enter email" required>
                        </div>
                        <div class="form-group mb-2">
                        <label for="filiere" class="col-sm-3 col-form-label">Filière</label>
                            <select class="form-select form-control-lg" id="filiere" name="filiere" required>
                            <option disabled selected value="">Filière</option>
                            <option value="ICT4D">ICT4D</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="filiere" class="col-sm-3 col-form-label">Niveau</label>
                            <select class="form-select form-control-lg" id="niveau" name="niveau" required>
                            <option disabled selected value="">Niveau</option>
                            <option value="L1">L1</option>
                            <option value="L2">L2</option>
                            <option value="L3">L3</option>
                            <!-- <option value="M1">M1</option>
                            <option value="M2">M2</option> -->
                            </select>                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                           <div class="form-group d-flex">
                           <input type="password" class="form-control" name="password" id="myInput"
                            value="<?php echo isset($_POST['password']) ? $password : '' ?>" placeholder="Password" required>
                           </div>
                        </div>
                        <div class="form-group mb-2">
                                <label for="confirm">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_pw" id="myInput" 
                                 placeholder="Password" required>
                            </div>
                            <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary my-2">Submit</button>
                            <p>If You Have An Account?<a href="./login.php" class="alert ms-5"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login now</a></p>
                      </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>