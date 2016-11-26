<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(0);//屏蔽错误信息
include('Helper.class.php');


if (!$_POST['enword'] == '') {
    search_enwrod($_POST['enword']);
}elseif (!$_POST['cnword'] == '') {
    search_cnwrod($_POST['cnword']);
}
else
{
    echo "请输入查询的单词 ";
}


// 查询英文
function search_enwrod($str)
{
   $link = new Helper();//连接数据库
   $sql = "select cnword from words where enword='$str'";
   $arr = $link->search($sql);
   // var_dump($arr);
   
   if(!$arr)
   {
        echo "查询失败,找不到该单词";
        
   }else{
        echo "<h4 ><span style='color:red;'>$str </span>的中文翻译如下:</h4>";
       echo '<div>'.implode($arr, ',').'</div>';
      
   }
  
}

// 查询中文
function search_cnwrod($str)
{
   $link = new Helper();//连接数据库
   $sql = "select enword from words where cnword = '$str'";
   $arr = $link->search($sql);
   // var_dump($arr);
   
   if($arr)
   {
        echo "<h4 ><span style='color:red;'>$str </span>的英文翻译如下:</h4>";
        echo '<div>'.implode($arr, ',').'</div>';
        
        
   }else{
        $sql = "select enword from words where cnword like '%$str%'";
        $arr2 = $link->search($sql);
        if ($arr2) {
            echo "<h4 ><span style='color:red;'>$str </span>英文翻译有以下可能:</h4>";
            echo '<div>'.implode($arr2, ',').'</div>';
        }
        else{
            echo "查询失败,找不到该单词";
        }
   }
  
}


echo "<a href='index.html'>返回查询</a>";
