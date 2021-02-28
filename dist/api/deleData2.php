<?php
    $data = $_POST['arr'];
    $arr = explode(',',$data);

    // if(!empty($data)){
    //     print_r($arr);
    // }else{
    //     echo "接收数组失败";
    // }

    $con = mysqli_connect('localhost','root','123456','system');
    for($x=0;$x<count($arr);$x++){
        $sql = "DELETE FROM `studentsmark` WHERE `number` = '$arr[$x]'";

        $res = mysqli_query($con,$sql);

        if(!$res){
            die('数据库链接错误' . mysqli_error($con));
        }
    }

    print_r(json_encode(array('code'=>$res,'msg'=>'删除成功'),JSON_UNESCAPED_UNICODE));

?>