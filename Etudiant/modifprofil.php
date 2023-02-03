<?php 

    session_start();
    $mat = $_SESSION['matricule'];

    require '../config/config.php';
    require '../config/bd.php';


    $query = " SELECT * FROM `etudiant` WHERE Matricule like '$mat'";
    $result = mysqli_query($conn,$query);
    $result_tab = mysqli_fetch_assoc($result);
    $nom = strval($result_tab['NomEtudiant']);
    $prenom= strval($result_tab['PrenomEtudiant']);
    $email = strval($result_tab['AdresseEmailEtudiant']);

    //Message Vars
    $msg = '';
    $msgClass = '';

    //Check for submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = test_input($_POST['name']);
        $surname = test_input($_POST['surname']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $confirm_pw = test_input($_POST['confirm_pw']);

        

        //Validation
        if (!empty($name) && !empty($surname)  && !empty($email)
            && !empty($password) && !empty($confirm_pw)){
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
                }else{
                    
                    //test password
                    if ($password != $confirm_pw) {
                        $msg = 'Please confirm Your Password';
                        $msgClass = 'alert-danger';
                    }else{

                        //tout est correct
                        $name = mysqli_real_escape_string($conn,$name);
                        $surname = mysqli_real_escape_string($conn,$surname);
                        $email = mysqli_real_escape_string($conn,$email);
                        $password = mysqli_real_escape_string($conn,$password);
                        $query = "UPDATE `etudiant` 
                            SET `NomEtudiant`='$nom',`PrenomEtudiant`='$surname',`MdpEtudiant`='$password',`AdresseEmailEtudiant`='$email' 
                                WHERE Matricule like '$mat' ";

                        $result = mysqli_query($conn,$query);        
                        $msg = 'Youpi Your Account is Up To Date';
                        $msgClass = 'alert-success';
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

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Update Account Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../dist/css/main.css"> -->

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
                    <div class="h3 text-center text-primary my-3 text-uppercase">Update Your Profile Account</div>
                    <form class="p-3" method ="post" 
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                    <div class="form-group mb-2">
                          <label for="validationCustom01" class="form-label">Name</label>
                          <input type="text" class="form-control" name="name" id="name" 
                          value="<?php echo isset($_POST['name']) ? $name : $nom ;?>" placeholder="Name" required>
                    </div>
                        <div class="form-group mb-2">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" name="surname" id="surname" 
                            value="<?php echo isset($_POST['surname']) ? $surname : $prenom ;?>" placeholder="Surname" required>
                        </div>
                       
                        <div class="form-group mb-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" 
                            value="<?php echo isset($_POST['email']) ? $email : $email ;?>" placeholder="Enter email" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                            value="<?php echo isset($_POST['password']) ? $password : ' mot de passe' ?>" placeholder="Password" required>
                        </div>
                        <div class="form-group mb-2">
                                <label for="confirm">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_pw" id="confirm" 
                                value="<?php echo isset($_POST['confirm_pw']) ? $confirm_pw : '' ?>" placeholder="Password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary my-2">Update</button>
                            <p>Go to Your Profile page? <a href="./profile.php" class="alert ms-5"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Check Now</a></p>
                      </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>