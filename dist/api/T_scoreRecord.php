<?php
    $name = $_POST['name'];
    $number = $_POST['number'];
    $chinese = $_POST['chinese'];
    $math = $_POST['math'];
    $english = $_POST['english'];
    $reward = $_POST['reward'];
    $remark = $_POST['remark'];

    $con = mysqli_connect('localhost','root','123456','system');

    $sql = "SELECT * FROM `studentsmark` WHERE `name` = '$name' AND `number` = '$number'";

    $res = mysqli_query($con,$sql);

    if(!$res){
        die('数据库链接错误' . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($res);

    if($row){
        // $sql1 = "UPDATE `studentsmark` SET `number` = '$number' WHERE `chinese` = '$chinese' AND `math` = '$math' AND `english` = '$englist' AND `reward` = '$reward' AND `remark` = '$remark'";
        $sql1 = "UPDATE `studentsmark` SET `chinese` = '$chinese', `math` = '$math', `english` = '$english', `reward` = '$reward', `remark` = '$remark' WHERE `studentsmark`.`number` = '$number'";

        $res1 = mysqli_query($con,$sql1);


        if(!$res1){
            die('数据库链接错误' .mysqli_error($con));
        }

        print_r(json_encode(array('code'=>$res1,"msg"=>"修改成功"),JSON_UNESCAPED_UNICODE));

    }else{
        // 判断传入的名字与学号是否与数据库里的匹配
        $sql3 = "SELECT * FROM `studentsmark` WHERE `name` = '$name' or `number` = '$number'";
        $res3 = mysqli_query($con,$sql3);
        if(!$res3){
            die ('数据库链接错误'.mysqli_error($con));
        }
        $row = mysqli_fetch_assoc($res3);
        if($row){
            print_r(json_encode(array('code'=> !$res3,"msg"=>"添加失败"),JSON_UNESCAPED_UNICODE));
            die();
        }
        

        $sql4 = "SELECT * FROM `studentdata` WHERE `name` = '$name' AND `number` = '$number'";
        $res4 = mysqli_query($con,$sql4);
        if(!$res4){
            die ('数据库链接错误'.mysqli_error($con));
        }
        $row4 = mysqli_fetch_assoc($res4);
        if(!$row4){
            $sql5 = "SELECT * FROM `studentdata` WHERE `name` = '$name' or `number` = '$number'";
            $res5 = mysqli_query($con,$sql5);
            $row5 = mysqli_fetch_assoc($res5);
            if($row5){
                print_r(json_encode(array('code'=> !$res3,'name'=> $name,"msg"=>"添加失败2"),JSON_UNESCAPED_UNICODE));
                die();
            }

             $sql6 = "INSERT INTO `studentdata` (`name`,`number`,`IDcard`,`nation`,`native`,`oldName`,`pingyin`,`type`) VALUES ('$name','$number',' ',' ',' ',' ',' ',' ')";
             $res6 = mysqli_query($con,$sql6);
             if(!$res6){
                die ('数据库链接错误1'.mysqli_error($con));
            }
        }

        // 添加新数据到studentsmark数据库
        $sql2 = "INSERT INTO `studentsmark` (`name`,`number`,`chinese`,`math`,`english`,`reward`,`remark`) VALUES ('$name','$number','$chinese','$math','$english','$reward','$remark')";
    
    

        $res2 = mysqli_query($con,$sql2);

        if(!$res2){
            die ('数据库链接错误'.mysqli_error($con));
        }

        print_r(json_encode(array('code'=>$res2,"msg"=>"添加成功"),JSON_UNESCAPED_UNICODE));
    }
    




?>