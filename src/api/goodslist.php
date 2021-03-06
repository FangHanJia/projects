<?php
    // 引入文件
    require('connect.php');

    // 获取前端的数据类型
    $type = isset($_GET['type']) ? $_GET['type'] : 'init';
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $min = isset($_GET['min']) ? $_GET['min'] : '';
    $max = isset($_GET['max']) ? $_GET['max'] : '';

    // 获取分页请求数据
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $qty  = isset($_GET['qty']) ? $_GET['qty'] : 20;


    // 获取数据库的所有数据
    $sql_cd    = "select * from index_countDown";
    $sql_hot   = "select * from index_hot";
    $sql_goods = "select * from goodslist";

    // 测试是否连接成功
    if($conn){

        if($type ==null ){
            echo '失败';
            return;
        }else if($type == 'init'){
            $result_cd = $conn->query($sql_cd);
            $res_cd = $result_cd->fetch_all(MYSQLI_ASSOC);

            $result_h = $conn->query($sql_hot);
            $res_h = $result_h->fetch_all(MYSQLI_ASSOC);
            
            // goods
            $result_g = $conn->query($sql_goods);
            $arr_g = $result_g->fetch_all(MYSQLI_ASSOC);

            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );

            // 关闭
            $result_cd->close();
            $conn->close();

            // 组成一个数组
            $arr = array("cd"=>$res_cd,"h"=>$res_h,"g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '销量'){
            $sql_sale = "SELECT * from goodslist ORDER BY salecount DESC";
            $result_sale = $conn->query($sql_sale);
            $arr_g = $result_sale->fetch_all(MYSQLI_ASSOC);
            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '人气'){
            $sql_sale = "SELECT * from goodslist ORDER BY saleprice DESC";
            $result_sale = $conn->query($sql_sale);
            $arr_g = $result_sale->fetch_all(MYSQLI_ASSOC);
            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '价格'){
            $sql_sale = "SELECT * from goodslist ORDER BY ourprice DESC";
            $result_sale = $conn->query($sql_sale);
            $arr_g = $result_sale->fetch_all(MYSQLI_ASSOC);
            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '综合'){
            // goods
            $result_g = $conn->query($sql_goods);
            $arr_g = $result_g->fetch_all(MYSQLI_ASSOC);

            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '选择'){
            $sql_sale = "SELECT * from goodslist WHERE des LIKE '%$name%'";
            $result_sale = $conn->query($sql_sale);
            $arr_g = $result_sale->fetch_all(MYSQLI_ASSOC);
            // 格式化数据
            $res_g = array(
                    "total"=>count($arr_g),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_g,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_g);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else if($type == '搜索'){
            $sql_set = "select * from goodslist where ourprice between '$min' and '$max' order by ourprice";
            $result_set = $conn->query($sql_set);
            $arr_set = $result_set->fetch_all(MYSQLI_ASSOC);
            // 格式化数据
            $res_set = array(
                    "total"=>count($arr_set),
                    "page"=>$page*1,
                    "qty"=>$qty*1,
                    "data"=>array_slice($arr_set,$qty*($page - 1),$qty)
                );
            // 组成一个数组
            $arr = array("g"=>$res_set);
            // 转为json字符串
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
?>