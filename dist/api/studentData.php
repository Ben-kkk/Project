<?php
    $number = $_POST['number'];

    $con = mysqli_connect('localhost','root','123456','system');

    $sql = "SELECT * FROM `studentdata` WHERE `number` = '$number'";

    $res = mysqli_query($con,$sql);

    if(!$res){
        die ('error for mysql:'. mysqli_error($con));
    }

    $arr = array();
    $row = mysqli_fetch_assoc($res);

    while($row){
        array_push($arr,$row);
        $row = mysqli_fetch_assoc($res);
    }
    
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
?>