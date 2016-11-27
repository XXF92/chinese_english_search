<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(0);//屏蔽错误信息
include('Helper.class.php');

// 添加操作
if ($_POST['new_en'] == '' && $_POST['new_cn'] == '') 
{
    // echo $_POST['new_en'],$_POST['new_cn'];
    die("请输入要添加的单词<a href='add.html'>返回</a>") ;
}
else
{
    $en = $_POST['new_en'];
    $cn = $_POST['new_cn'];
    $str = insert($en,$cn);
    echo $str;
}



// 添加新单词
function insert($en,$cn)
{
    $sql = "insert into words (enword,cnword) value ('$en','$cn')";
    $link = new Helper();//连接数据库
    $link->add($sql);
    if ($link) {
        return "添加成功";
    }
    else
    {
        return "添加失败";
    }
}

echo "<a href='add.html'>返回查询</a>";