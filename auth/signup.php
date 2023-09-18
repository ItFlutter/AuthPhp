<?php
include "../connect.php";
$data=array();
$username=$_POST['name'];
$email=$_POST['email'];
$password=sha1($_POST['password']);
$phone=$_POST['phone'];
$verifyCode=rand(1000,10000);
$stmt1=$con->prepare("select * from users where users_email=?");
$stmt1->execute(array($email));
$data=$stmt1->fetch(PDO::FETCH_ASSOC);

$count1=$stmt1->rowCount();
if($count1>0){
    if("$data[users_approve]"=="0"){
echo json_encode(array("status"=>"failureverifycode"));
$stmt2=$con->prepare("update users set users_name=?,users_password=?,users_phone=?,users_verifycode=? where users_email=?");
$stmt2->execute(array($username,$password,$phone,$verifyCode,$email));

//resend verifycode
// $header="From: support@ahmad.com " . "\n" . "CC: medomode197@gmail.com";
        // sendEmail($email,"Verfiy Code Ecommerce","Verfiy code $verifycode");
// mail("ahmadomran921@gmail.com","Form Course Flutter",$verifyCode,"From Hosting");
// $header="From: support@ahmad.com ";
// mail($email,"Verfiy Code First Project","Verfiy Code $verifyCode",$header);

    }else{

        echo json_encode(array("status"=>"failureemail"));
    }
}else{

    $stmt=$con->prepare("insert into users (users_name,users_email,users_password,users_phone,users_verifycode) values (?,?,?,?,?)");
    $stmt->execute(array($username,$email,$password,$phone,$verifyCode));
    $header="From: support@ahmad.com ";
    // mail($email,"Verfiy Code First Project","Verfiy Code $verifyCode",$header);

    $count=$stmt->rowCount();
    if($count>0){
    echo json_encode(array("status"=>"success"));
    }else{
    echo json_encode(array("status"=>"failure"));
    
    }
}


?>