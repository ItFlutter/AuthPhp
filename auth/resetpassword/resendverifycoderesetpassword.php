<?php
include "../../connect.php";
$data=array();
$email=$_POST['email'];
$stmt=$con->prepare("select * from users where users_email =? and users_approve=?");
$stmt->execute(array($email,"1"));
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();
#
if($count>0){
    //resendverifycode
    // $header="From: support@ahmad.com ";
    // mail($email,"Verfiy Code First Project","Verfiy Code ".$data['users_verifycode'],$header);
echo json_encode(array("status"=>"success"));


}

else{

    echo json_encode(array("status"=>"failure"));



}?>