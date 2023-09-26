<html>
<head><title>目次</title></head>
<body>
目次
<ul>
<li><a href="//trap.example.com/firefox_tcp.html">（設定をお願いします）Firefoxのトータルクッキー保護導入に伴う設定変更</a></li>
</ul>
<ul>
<li><a href="/31/">3.1 HTTPとセッション管理</a></li>
<li><a href="/32/">3.2 受動的攻撃と同一生成元ポリシー</a></li>
<li><a href="/33/">3.3 CORS（Cross-Origin Resource Sharing）</a></li>
<li><a href="/42/">4.2 入力処理とセキュリティ</a></li>
<li><a href="/43/">4.3 表示処理に伴う問題</a></li>
<li><a href="/44/">4.4 SQL呼び出しに伴う脆弱性</a></li>
<li><a href="/45/">4.5 「重要な処理」の際に混入する脆弱性</a></li>
<li><a href="/46/">4.6 セッション管理の不備</a></li>
<li><a href="/47/">4.7 リダイレクト処理にまつわる脆弱性</a></li>
<li><a href="/48/">4.8 クッキー出力にまつわる脆弱性</a></li>
<li><a href="/49/">4.9 メール送信の問題</a></li>
<li><a href="/4a/">4.10 ファイルアクセスにまつわる問題</a></li>
<li><a href="/4b/">4.11 OSコマンド呼び出しの際に発生する脆弱性</a></li>
<li><a href="/4c/">4.12 ファイルアップロードにまつわる問題</a></li>
<li><a href="/4d/">4.13 インクルードにまつわる問題</a></li>
<li><a href="/4e/">4.14 構造化データの読み込みにまつわる問題</a></li>
<li><a href="/4f/">4.15 共有資源やキャッシュにまつわる問題</a></li>
<li><a href="/4g/">4.16 Web APIにまつわる問題</a></li>
<li><a href="/4h/">4.17 JavaScriptの問題</a></li>
<li><a href="/51/">5.1 認証</a></li>
<li><a href="/63/">6 文字コードとセキュリティ</a></li>
<li><a href="/todo/">7 Bad Todo（脆弱性診断サンプルアプリケーション）</a></li>
<li><a href="/rips/">7 RIPS</a></li>
</ul>
<?php
  $docker = isset($_ENV['REDIRECT_MYSQL_HOST']) || isset($_ENV['MYSQL_HOST']);
  if ($docker): ?>
<a href="/mail/">Webメール(MailCatcher)</a><br>
<a href="/adminer.php?server=db&username=root">adminer</a><br>
<?php else: ?>
<a href="/mail/">Webメール(Roundcube)</a><br>
<a href="/phpmyadmin/">phpMyAdmin</a><br>
<?php endif; ?>
<a href="foxyproxy.json" download="foxyproxy.json">Foxyproxyの設定ファイル</a><br>
<a href="phpinfo.php">phpinfo</a>
</body>
</html>
