<?php
// 注意：このダウンロードスクリプトにはクロスサイト･スクリプティング脆弱性があります
//
define('UPLOADPATH', '/var/upload');
$mimes = array('gif' => 'image/gif', 'jpg' => 'image/jpeg', 'png' => 'image/png',);
$file = $_GET['file'];
$info = pathinfo($file); // ファイル情報の取得
$ext = strtolower($info['extension']); // 拡張子（小文字に統一）
$content_type = $mimes[$ext]; // Content-Typeの取得
if (! $content_type) {
  die('拡張子はgif、jpg、pngのいずれかを指定ください');
}
header('Content-Type: ' . $content_type);
readfile(UPLOADPATH . '/' . basename($file));
