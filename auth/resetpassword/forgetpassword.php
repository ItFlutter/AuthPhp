<?php
include "../../connect.php";
$email=$_POST['email'];
$data=array();
$stmt=$con->prepare("select * from users where users_email=? and users_approve=?");
$stmt->execute(array($email,"1"));
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();
if($count>0){
    $verifyCode=$data['users_verifycode'];
//     $header="From: support@ahmad.com ";
// mail($email,"Verfiy Code First Project","Verfiy Code $verifyCode",$header);
    // echo $verifyCode;
    //send verifycode
echo json_encode(array("status"=>"success"));

}else{
    echo json_encode(array("status"=>"failure"));
}
?>