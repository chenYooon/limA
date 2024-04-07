<?php

$host = '47.116.192.163';
$db   = '律云通晓';
$user = 'root';
// $pass = 'root';
$pass = 'SUFEcs@2024';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$q = $_GET['q'];
$hint = "";
if (strlen($q) > 0) {
    $stmt = $pdo->prepare("SELECT HTst, HTlink FROM hottopic WHERE HTst LIKE ?");
    $stmt->execute(["%$q%"]);
    $links = [];
    while ($row = $stmt->fetch()) {
        // $links[] = "<option value='" . $row['HTst'] . "'>";
        // $links[] = "<option value='<a href='" . $row['HTlink'] . "' target='_blank'>" . $row['HTst'] . "</a>";
        // 然而，<option> 标签的 value 属性并不支持 HTML 标签，因此我们不能直接在 value 属性中插入 <a> 标签。但我们可以通过另一种方式来实现这个功能。
        // 我们可以在生成 <option> 标签时，将链接存储在 data-link 属性中。然后，我们可以添加一个事件监听器来监听输入框的 change 事件。当用户选择一个选项时，我们可以获取该选项的 data-link 属性，并导航到相应的链接。
        $links[] = "<option value='" . $row['HTst'] . "'>";
    }
    $hint = implode("\n", $links);
}

echo $hint;
?>

<!-- if (strlen($q) > 0) {
    $stmt = $pdo->prepare("SELECT HTst, HTlink FROM HotTopic WHERE HTst LIKE ?");
    $stmt->execute(["%$q%"]);
    $links = [];
    while ($row = $stmt->fetch()) {
        $links[] = "<a href='" . $row['HTlink'] . "' target='_blank'>" . $row['HTst'] . "</a>";
    }
    $hint = implode("<br />", $links);
}


if ($hint == "") {
    $response = "no suggestion";
} else {
    $response = $hint;
}

echo $response;
?> -->


