<?php
require_once('./common.php');

try {
  $dbh = dblogin();

  $userid = filter_input(INPUT_POST, "id");
  if (! ereg('^[a-zA-Z0-9]{1,16}$', $userid)) {
    die("ユーザIDは英数字で16文字以内で指定してください");
  }
  $sql = "SELECT userid FROM users WHERE id=?";
  $sth = $dbh->prepare($sql);
  $sth->execute(array($userid));
  if ($sth->fetch()) {
    die("このユーザID($userid)は既に登録されています");
  }
  $pwd   = filter_input(INPUT_POST, "pwd");
  if (mb_strlen($pwd) < 4) {
    die("パスワードは4文字以上で指定してください");
  }
  $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
  if (! $email) {
    die("メールアドレスの形式が不正です");
  }
  $sql = "SELECT userid FROM users WHERE email=?";
  $sth = $dbh->prepare($sql);
  $sth->execute(array($email));
  if ($sth->fetch()) {
    die("このメールアドレス($email)は既に登録されています");
  }
  $icon  = $_FILES["icon"];
  if ($icon['error'] !== 0) {
    die('アイコン画像を指定してください');
  }
  $tmp_name = $icon["tmp_name"];
  $iconfname = $icon["name"];
  if (! image_file($iconfname)) {
    die('アイコン画像の拡張子は png/gif/jpg/jpeg のいずれかを指定ください');
  }
  $iconrealfname = uniqid() . '-' . $iconfname;
  move_uploaded_file($tmp_name, "temp/$iconrealfname");
} catch (PDOException $e) {
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}

?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>会員登録</title>
</head>
<body>
<div id="top">
  <?php require "menu.php"; ?>
  <div id="confirm">
    入力を確認してください<BR>
    <form action="adduser.php" method="POST">
      <table>
        <tr>
        <td>ユーザID</td><td><?php e($userid); ?></td>
        </tr>
        <tr>
        <td>パスワード</td><td>********</td>
        </tr>
        <tr>
        <td>Eメール</td><td><?php e($email); ?></td>
        </tr>
        <tr>
        <td>アイコンファイル</td><td><img src="<?php echo "temp/$iconrealfname" ?>"></td>
        </tr>
        <tr>
        <td></td><td><input type=submit value="登録"></td>
        </tr>
      </table>
      <?php
        foreach ($_POST as $key => $value) {
          echo '<input name="' . $key . '" type="hidden" value="' . h($value) . "\">\n";
        }
        echo '<input name="iconfname" type="hidden" value="' . h($iconrealfname) . '">';
      ?>
    </form>
  </div><!-- #confirm -->
  <?php require "footer.php"; ?>
</div> <!-- #top -->
</body>
</html>
