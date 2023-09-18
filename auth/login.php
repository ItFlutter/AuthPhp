<?php
include "../connect.php";
$data=array();
$email=$_POST['email'];
$password=sha1($_POST['password']);
$stmt=$con->prepare('select * from users where users_email=? and users_password=?');
$stmt->execute(array($email,$password));
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();


    if($count>0){
        if($data['users_approve']=="0"){
            //resend verifycode
            // $header="From: support@ahmad.com ";

            // mail($email,"Verfiy Code First Project","Verfiy Code ".$data['users_verifycode'],$header);
            echo json_encode(array("status"=>"failureverifycode"));
        
        }else
        {
            echo json_encode(array("status"=>"success","data"=>$data));

        }
    }else{
        echo json_encode(array("status"=>"failure"));
    
  }


?>