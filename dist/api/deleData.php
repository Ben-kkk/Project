<?php
    $number = $_POST['number'];

    $con = mysqli_connect('localhost','root','123456','system');

    $sql = "DELETE FROM `studentsmark` WHERE `number` = '$number'";

    $res = mysqli_query($con,$sql);


    if(!$res){
        die('数据库链接错误' . mysqli_error($con));
    }

    print_r(json_encode(array('code'=>$res,'msg'=>'删除成功'),JSON_UNESCAPED_UNICODE));



?>