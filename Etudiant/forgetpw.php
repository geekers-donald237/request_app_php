<?php 
    require '../config/config.php';
    require '../config/bd.php';

    //Message Vars
    $msg = '';
    $msgClass = '';

    //Check for submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $matricule = test_input($_POST['Matricule']);
        if (!empty($matricule)) { 
            $matricule = mysqli_real_escape_string($conn,$matricule);
            $query1 = 'SELECT `Matricule`FROM `etudiant`';
            $result1 = mysqli_query($conn,$query1);
            $matricules = mysqli_fetch_all($result1,MYSQLI_ASSOC);
            mysqli_free_result($result1);
            foreach ($matricules as $mail) {
                
                if (strtolower($matricule)  == strtolower($mail['Matricule'])) {
                session_start();  
                $_SESSION['matricule'] =strtolower( $mail['Matricule']);
                header('Location:setnewpw.php');
                break;
                        
                } else {
                    $msg = 'Incorrect Matricule !! ';
                    $msgClass = 'alert-danger';
                }
            }
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
    <title>Forget Password Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body  class="border login border-3">
    <section class="p-5  rounded h-100 ">
        <div class="container h-100 rounded">
        <?php if($msg != '') :?>
                <div class="alert <?php echo $msgClass?>">
                    <?php echo $msg; ?>
                </div>
            <?php endif;?>
            <div class="row h-100 justify-content-between align-items-center g-3">
            <div class="col-lg-6 col-md d-none d-md-block">
                    <img src="../dist/assets/img/OIP (4).jpg" alt="" class="img-fluid">
                </div>
                <div class="col-md bg-light shadow border">
                    <div class="h1 text-center text-primary my-3 text-uppercase">Forget Password</div>
                    <form class="p-3" method ="post" 
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                        <div class="form-group mb-2">
                          <label for="email">Matrcicule</label>
                          <input type="text" class="form-control" id="Matricule" name="Matricule" placeholder="Matricule" required>   
                         </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <p> If You Have An Account??
                        </p> <a href="./login.php" class="alert ms-5"><i class="fa-solid fa-unlock-keyhole"></i>
                              Login Now</a>
                      </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>