<?php
  $user = $_GET['user'];
  if ($user === 'tanaka' || $user === 'yamada') {
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    echo '<body>';
    echo 'ログインしました(' . htmlspecialchars($user) . ')<br>';
?>
<a href="4f-012.php">マイページ（キャッシュなし）</a><br>
<a href="4f-012a.php">マイページ（キャッシュあり）</a>
</body>
<?php
  } else {
    die('ユーザ名が違います');
  }
