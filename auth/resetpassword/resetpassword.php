<?php
include "../../connect.php";
$email=$_POST['email'];
$password=sha1($_POST['password']);
$stmt=$con->prepare("update users set users_password=? where users_email=?");
$stmt->execute(array($password,$email));
$count=$stmt->rowCount();
if($count>0){
    echo json_encode(array("status"=>"success"));
}else{
    echo json_encode(array("status"=>"failure"));

}

?>