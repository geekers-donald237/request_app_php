<?php 
require_once("./config.php");


$id = $_GET['id'];

$stmt=mysqli_query($db,"SELECT PiecesJointes FROM `requete` WHERE idRequete = $id ");
$count=mysqli_num_rows($stmt);
if($count==1){
    $row=mysqli_fetch_array($stmt);
    $image=$row['PiecesJointes'];
    $file='uploads/'.$image;
    if (headers_sent()){
        echo 'HTTP header already sent';
    } else {
        ob_end_clean();
        header("Content-Type: application/image");
        header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
        readfile($file);
        exit;  
    }
    // header('Location:Response.php');
    echo "<script>window.close();</script>";
}else{
    echo 'File not found '; 
} 
?>