<?php
require_once './common.php';
require_loggedin();

$todo       = filter_input(INPUT_POST, "todo");
$due_date   = filter_input(INPUT_POST, "due_date");
if (empty($due_date))
  $due_date = null;
$public     = filter_input(INPUT_POST, "public") ? 1 : 0;
$token      = filter_input(INPUT_POST, TOKENNAME);
$attachment = $_FILES["attachment"];

require_token($token);
$id = $user->get_id();
$name = null;
if (empty($todo)) {
  die('todoが空です');
}
$org_filename = null;
$real_filename = null;
if ($attachment['error'] === 0) {
  $tmp_name = $attachment["tmp_name"];
  $org_filename = $attachment["name"];
  if (! safe_file($org_filename)) {
    die('この拡張子のファイルはアップロードできません');
  }
  $real_filename = dechex(time()) . "-" . $org_filename;
  move_uploaded_file($tmp_name, "attachment/$real_filename");
}

try {
  $dbh = dblogin();

  $sql = 'INSERT INTO todos (owner, todo, due_date, org_filename, real_filename, public)  VALUES(?, ?, ?, ?, ?, ?)';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($id, $todo, $due_date, $org_filename, $real_filename, $public));

} catch (PDOException $e) {
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>Todo追加</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    1件追加しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
