<?php
require_once './common.php';
$token = filter_input(INPUT_POST, TOKENNAME);
require_token($token);

$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
if ($email === false) {
  die('メールアドレスの形式が不正です');
}
$name  = filter_input(INPUT_POST, "name");
$subject = filter_input(INPUT_POST, "subject");
$question  = filter_input(INPUT_POST, "question");

$descriptorspec = array(
  0 => array("pipe", "r"),
  1 => array("pipe", "w"),
  2 => array("file", "/tmp/php-error-output.txt", "a"));

$process = proc_open("/usr/sbin/sendmail -i -t", $descriptorspec, $pipes);
if (is_resource($process)) {
  fputs($pipes[0], "From: contact@example.jp\n");
  fputs($pipes[0], "To: $email\n");
  fputs($pipes[0], "Subject: お問い合わせ($subject)を受け付けました\n");
  fputs($pipes[0], "Mime-Version: 1.0\n");
  fputs($pipes[0], "Content-Type: text/plain; charset=\"UTF-8\"\n");
  fputs($pipes[0], "Content-Transfer-Encoding: 8bit\n");
  fputs($pipes[0], "\n");
  fputs($pipes[0],  
	"毎々お引き立て頂きありがとうございます。\n" .
	"以下の質問を受け付けましたのでご確認くださいませ。\n\n" .
	$question);
  fputs($pipes[0], ".\n");
  fclose($pipes[0]);

  e(stream_get_contents($pipes[1]));
  fclose($pipes[1]);

  $return_value = proc_close($process);
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>問い合わせ</title>
</head>
<body>
<div id="top">
<?php $menu = 6; require "menu.php"; ?>
  <div id="done">
  お問合せを受け付けました。
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
