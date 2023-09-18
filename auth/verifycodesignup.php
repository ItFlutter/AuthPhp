<?php
include "../connect.php";
$verifyCode=$_POST['verifycode'];
$email=$_POST['email'];
$stmt=$con->prepare("select * from users where users_verifycode=? and users_email =? and users_approve=?");
$stmt->execute(array($verifyCode,$email,"0"));
$count=$stmt->rowCount();
if($count>0){
    $stmt1=$con->prepare("update users set users_approve=? where users_email=?");
    $stmt1->execute(array("1",$email));

echo json_encode(array("status"=>"success"));

}else{
    echo json_encode(array("status"=>"failure"));

}

?>