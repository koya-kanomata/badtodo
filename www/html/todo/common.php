<?php
define('SESSIDNAME', 'TODOSESSID');
define('TOKENNAME', 'todotoken');
define('TOKENLEN', 24);

class User {
  private $id;
  private $userid;
  private $super;
  function __construct($id = false, $userid = false, $super = 0) {
    $this->id = $id;
    $this->userid = $userid;
    $this->super = $super;
  }
  public function get_id() {
    return $this->id;
  }
  public function get_userid() {
    return $this->userid;
  }
  public function is_super() {
    return $this->super ? 1 : 0;
  }
}

function is_loggedin() {
  return isset($_SESSION['login']) &&  $_SESSION['login'] === true;
}

function require_loggedin() {
  if (! is_loggedin()) {
    $user = new User();
    $current = $_SERVER['PHP_SELF'];
    $title = "ログアウトしています";
    $content = "ログアウトしています。<a href='login.php?url=$current'>ログイン</a>";
    require "template.php";
    exit;
  }
}

function get_token() {
  if (empty($_SESSION[TOKENNAME])) {
    $token = bin2hex(openssl_random_pseudo_bytes(TOKENLEN));
    $_SESSION[TOKENNAME] = $token;
  } else
    $token = $_SESSION[TOKENNAME];
  return $token;
}

function require_token($token) {
  if (empty($_SESSION[TOKENNAME]) || $_SESSION[TOKENNAME] !== $token) {
    die('正規の画面から使用下さい');
  }
}

class Logger {
  const LOGDIR = '/var/www/html/todo/logs/';  // ログ出力ディレクトリ
  private $filename = '';  // ログファイル名
  private $log = '';       // ログバッファ

  public function __construct($filename) {  // コンストラクタ…ファイル名を指定
    $this->filename = basename($filename); // ファイル名
    $this->log = '';             // ログバッファ
  }

  public function __destruct() { // デストラクタではバッファの中身をファイルに書き出し
    if (empty($this->log))
      return;
    $path = self::LOGDIR . $this->filename;  // ファイル名の組み立て
    $fp = fopen($path, 'a+');
    if ($fp === false) {
      die('Logger: ファイルがオープンできません' . htmlspecialchars($path));
    }
    fwrite($fp, $this->log); // ログの書き出し
    fclose($fp);
  }

  public function add($log) {  // ログ出力
    $this->log .= date("Y/m/d H:i:s") . " : " . $_SERVER['SCRIPT_FILENAME'] . ":" . $log . "\n";        // バッファに追加するだけ
  }
}

function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function e($s)
{
  echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function dblogin() {
  $dbhost = isset($_ENV['REDIRECT_MYSQL_HOST']) ? $_ENV['REDIRECT_MYSQL_HOST'] : '127.0.0.1';
  $dbh = new PDO("mysql:host=$dbhost;dbname=todo", 'root', 'wasbook');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->query("SET NAMES utf8");
  return $dbh;
}

function safe_file($filename) {
  $unsafe_ext_array = array('php', 'html', 'htm', 'exe');
  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  return ! in_array($ext, $unsafe_ext_array);
}

function image_file($filename) {
  $img_ext_array = array('gif', 'jpeg', 'jpg', 'png');
  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  return in_array($ext, $img_ext_array);
}

function requested_id($user, $method = INPUT_GET) {
  $id = $user->get_id();
  $reqid = filter_input($method, 'id');
  if (empty($reqid))
    $reqid = $id;
  if (! $user->is_super() && $id !== $reqid) {
    die('権限がありません');
  }
  return $reqid;
}

$logger = new Logger('todolog');

session_cache_expire(1);
session_name(SESSIDNAME);
session_cache_limiter('public');  // キャッシュを有効にする
session_start();
if (! empty($_COOKIE['USER']) && is_loggedin()) {
  $user = unserialize($_COOKIE['USER']);
} else {
  $user = new User();
}
