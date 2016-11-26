<?php
header("Content-type:text/html;charset=utf-8");
// 数据库查询类
class Helper
{
    private $conn;//数据库连接
    private $host;//连接主机
    private $user;//用户名
    private $psd;//密码
    private $db = 'word';//数据库名

    //连接数据库
    public function __construct()
    {
        $this->conn = mysql_connect('localhost','root','root') or die(mysql_error());
        mysql_query('set names utf8',$this->conn) or die(mysql_error());
        mysql_query("use $this->db",$this->conn) or die(mysql_error());
    }
    //单词查询
    function search($sql)
    {
        $arr = array();
        $res = mysql_query($sql,$this->conn);
        if(!$res)
        {
            return false;
        }
        else
        {
            while ($row = mysql_fetch_row($res))
            {
               foreach ($row as $value) 
               {
                   $arr[] = $value;
               }
            }
            mysql_free_result($res);
            return $arr;
        }
    }

    // 数据添加
    function add($sql)
    {
        $res = mysql_query($sql,$this->conn);
        if(!$res)
        {
            return false;
        }
        else
        {
            $id = mysql_insert_id($res);
            mysql_free_result($res);
            return $id;
        }
    }



}
