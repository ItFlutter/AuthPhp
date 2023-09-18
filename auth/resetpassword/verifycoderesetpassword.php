<?php
include "../../connect.php";
$verifyCode=$_POST['verifycode'];
$email=$_POST['email'];
$stmt=$con->prepare("select * from users where users_verifycode=? and users_email =?");
$stmt->execute(array($verifyCode,$email));
$count=$stmt->rowCount();
if($count>0){
echo json_encode(array("status"=>"success"));

}else{
    echo json_encode(array("status"=>"failure"));

}

?>