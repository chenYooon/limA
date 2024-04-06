<?php
$servername = "localhost";
$db = "律云通晓";
$username = "root";
$password = "root";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    echo "连接成功"; 
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>

<!-- 在PHP 8中推荐使用PDO -->


<!-- 用PHP创建数据库
$servername = "localhost";
$username = "username";
$password = "password";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);

    // 设置 PDO 错误模式为异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE myDBPDO";
    // 使用 exec() ，因为没有结果返回
    $conn->exec($sql);

    echo "数据库创建成功<br>";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null; -->

