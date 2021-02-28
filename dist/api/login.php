<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    $con = mysqli_connect('localhost','root','123456','system');

    $sql = "SELECT * FROM `login` WHERE `username` = '$username' AND `password` = '$password' AND `userType` = '$userType'";

    $res = mysqli_query($con,$sql);

    if(!$res){
        die ('error for mysql:'. mysqli_error());
    }

    $row = mysqli_fetch_assoc($res);
    if(!$row){
        echo json_encode(array(
      "code" => 0,
      "message" => "登录失败"
    ));
    }else{
      if($userType == 'student'){
        echo json_encode(array(
          "code" => 1,
          "message" => "登录成功"
        ));
      }else{
        echo json_encode(array(
          "code" => 2,
          "message" => "登录成功"
        ));
      }

      

        
    }

    


?>