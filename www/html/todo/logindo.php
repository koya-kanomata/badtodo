<?php
  require_once './common.php';
  try {
    $rnd = uniqid();
    $dbh = dblogin();
    $userid = filter_input(INPUT_POST, 'userid');
    $pwd = mb_substr(filter_input(INPUT_POST, 'pwd'), 0, 6);
    $url = filter_input(INPUT_POST, 'url');

    $sql = "SELECT id, userid FROM users WHERE userid='$userid'";
    $sth = $dbh->query($sql);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $sth = null;
    if (! empty($row)) {
      $sqlstm = "SELECT id, userid, super FROM users WHERE userid='$userid' AND pwd='$pwd'";
      $sth = $dbh->query($sqlstm);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
      if (! empty($row)) {
        $_SESSION['login'] = true;
        $user = new User($row['id'], $userid, $row['super']);
        setcookie('USER', serialize($user), 0, '/');
        header('Location: ' . $url . '?rnd=' . h($rnd) . '&' . SID);
      } else {
        e("パスワードが違います");
        exit;
      }
    } else {
      e("そのユーザーは登録されていません");
      exit;
    }
  } catch (PDOException $e) {
    die('接続に失敗しました: ' . $e->getMessage());
  }
?><body>
ログイン成功しました<br>
自動的に遷移しない場合は以下のリンクをクリックして下さい。
<a href="<?php echo "$url?rnd=" . h($rnd); ?>">todo一覧に遷移</a>        
</body>
