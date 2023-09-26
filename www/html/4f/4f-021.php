<?php
  $user = $_GET['user'];
  if ($user === 'tanaka' || $user === 'yamada') {
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    echo '<body>';
    echo 'ログインしました(' . htmlspecialchars($user) . ')<br>';
    echo '<a href="4f-022.php">マイページ</a><br>';
    echo '</body>';
  } else {
    die('ユーザ名が違います');
  }
