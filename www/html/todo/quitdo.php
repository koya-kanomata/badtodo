<?php
require_once './common.php';
require_loggedin();

$pwd   = mb_substr(filter_input(INPUT_POST, "pwd"), 0, 6);
$token = filter_input(INPUT_POST, TOKENNAME);
$id = $user->get_id();
$reqid = requested_id($user, INPUT_POST);

try {
  $dbh = dblogin();
  $dbh->beginTransaction();

  $sql = 'SELECT pwd FROM users WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($id)); // 現在ログイン中のユーザのパスワードなので $id でよい
  $row = $sth->fetch(PDO::FETCH_ASSOC);
  if ($pwd !== $row['pwd']) {
    die('パスワードが違います');
  }

  $sql = "SELECT real_filename FROM todos WHERE owner=?";
  $sth = $dbh->prepare($sql);
  $sth->execute(array($reqid));
  foreach ($sth as $row) {
    $attachment = $row['real_filename'];
    @unlink("attachment/$attachment");
  }

  $sql = 'DELETE FROM todos WHERE owner=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($reqid));

  $sql = "SELECT icon FROM users WHERE id=?";
  $sth = $dbh->prepare($sql);
  $sth->execute(array($reqid));
  $iconfilename = $sth->fetchColumn();
  @unlink("icons/$iconfilename");
  @unlink("icons/_64_$iconfilename");  // _64_ 付きのファイルはリサイズ後のもの

  $sql = 'DELETE FROM users WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($reqid));
  if ($reqid == $id) {
    session_destroy();
    $_SESSION = array();
  }
  $dbh->commit();
} catch (PDOException $e) {
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  if (isset($dbh)) {
    $dbh->rollBack();
  }
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>退会しました</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    退会しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
