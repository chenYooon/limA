<?php

// // 读取HTML文件
// $html = file_get_contents('../要闻挖掘search.html');
// // 找到需要替换的标签
// $pattern = '/<div style="color:rgb\(46, 160, 122\);float:left">#.*?#<\/div>/';
// // 创建新的标签
// $replacement = '<div style="color:rgb(46, 160, 122);float:left">#' . $q . '#</div>';
// // 替换标签
// $newHtml = preg_replace($pattern, $replacement, $html);
// // 将新的HTML内容写回文件
// file_put_contents('../要闻挖掘search.html', $newHtml);
// // 重定向用户到新的URL
// // header('Location: 要闻挖掘search.html');
// // 输出JavaScript代码，打开新的URL
// // echo '<script>window.open("../要闻挖掘search.html", "_blank");</script>';
// // 输出新的HTML内容
// // echo $newHtml;
// else{
//     echo "没有找到匹配的结果。";
// }
// 输出JavaScript代码，打开新的URL
// echo '<script>window.open("../要闻挖掘search.html", "_blank");</script>';

// $host = 'localhost';
// $db = '律云通晓';
// $user = 'root';
// $pass = 'root';
// $charset = 'utf8mb4';
$host = '47.116.192.163';
$db   = '律云通晓';
$user = 'root';
$pass = 'SUFEcs@2024';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$q = $_GET['q'];


if (strlen($q) > 0) {
    $stmt = $pdo->prepare("
    SELECT HTst,WBtext,UserName,WBdatetime,WBtrans,WBlike,WBcom 
    FROM hottopic H
    left join weibo W on H.HTID=W.HTID
    WHERE HTst LIKE ?
    ");
    $stmt->execute(["%$q%"]);
    $row = $stmt->fetchAll();
    if (!empty($row)) {
        // 读取HTML文件
        $html = file_get_contents('../要闻挖掘search.html');

        // 找到需要替换的标签，并创建新的标签
        $patterns = [
            '/<div style="color:rgb\(46, 160, 122\);float:left">#.*?#<\/div>/',
            // '/<div id="topicEcho" style="color:rgb(46, 160, 122);float:left">.*?<\/div>/s',

            '/<p id="WeiBoText1">.*?<\/p>/s',
            '/<span class="text-sm" id="WeiBoUser1">.*?<\/span>/s',
            '/<span class="text-sm mr-2" id="WeiBoTime1">.*?<\/span>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeiBoTrans1">.*?<\/button>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeiBoLike1">.*?<\/button>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeBoCom1">.*?<\/button>/s',

            '/<p id="WeiBoText2">.*?<\/p>/s',
            '/<span class="text-sm" id="WeiBoUser2">.*?<\/span>/s',
            '/<span class="text-sm mr-2" id="WeiBoTime2">.*?<\/span>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeiBoTrans2">.*?<\/button>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeiBoLike2">.*?<\/button>/s',
            '/<button class="btn btn-outline-primary btn-xs" id="WeBoCom2">.*?<\/button>/s',
            
            // 添加更多的模式...
        ];
        $replacements = [
            // '<div id="topicEcho" style="color:rgb(46, 160, 122);float:left">#'. $q.'#</div>',
            '<div style="color:rgb(46, 160, 122);float:left">#' . $q . '#</div>',

            '<p id="WeiBoText1">' . $row[0]['WBtext'] . '</p>',
            '<span class="text-sm" id="WeiBoUser1"><i class="far fa-user mr-1"></i>'. $row[0]['UserName'] .'</span>&nbsp;&nbsp',
            '<span class="text-sm mr-2" id="WeiBoTime1"><i class="far fa-calendar-alt mr-1"></i>' . $row[0]['WBdatetime'] .'</span>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoTrans1">转发数'. $row[0]['WBtrans'] .'</button>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoLike1">点赞数'. $row[0]['WBlike'] .'</button>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoCom1">评论数'. $row[0]['WBcom'] .'</button>',
            
            '<p id="WeiBoText2">' . $row[1]['WBtext'] . '</p>',
            '<span class="text-sm" id="WeiBoUser2"><i class="far fa-user mr-1"></i>'. $row[1]['UserName'] .'</span>&nbsp;&nbsp',
            '<span class="text-sm mr-2" id="WeiBoTime2"><i class="far fa-calendar-alt mr-1"></i>' . $row[1]['WBdatetime'] .'</span>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoTrans2">转发数'. $row[1]['WBtrans'] .'</button>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoLike2">点赞数'. $row[1]['WBlike'] .'</button>',
            '<button class="btn btn-outline-primary btn-xs" id="WeiBoCom2">评论数'. $row[1]['WBcom'] .'</button>',
            // 添加更多的替换...
        ];

        // 替换标签
        $newHtml = preg_replace($patterns, $replacements, $html);

        // 将新的HTML内容写回文件
        file_put_contents('../要闻挖掘search.html', $newHtml);
    }
    header('Location: ..\要闻挖掘search.html');
}



?>
