<?php
require_once './common.php';
$id    = filter_input(INPUT_POST, "id");
$pwd   = mb_substr(filter_input(INPUT_POST, "pwd"), 0, 6);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
if ($email === false) {
  die('メールアドレスの形式が不正です');
}
$icon  = filter_input(INPUT_POST, "iconfname");

try {
  $dbh = dblogin();

  $sql = 'INSERT INTO users VALUES(NULL, ?, ?, ?, ?, 0)';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($id, $pwd, $email, $icon));
  rename("temp/$icon", "icons/$icon");
} catch (PDOException $e) {
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>会員登録</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    登録しました。<BR><BR>続いて <a href="./login.php?url=todolist.php">ログイン</a> してください。<br>
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
