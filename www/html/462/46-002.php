<?php
  session_start();
?>
<head>
<meta name="referrer" content="unsafe-url">
</head>
<body>
  <a href="http://trap.example.com/462/46-900.cgi">外部サイトへのリンク</a><br>
<br>
<br>
<br>
<br>
<br>
<p>
  ※ Firefox 87.0（2021年3月リリース）にてリファラポリシーが変更されたため、デフォルトの状態ではクロスオリジンではリファラにクエリ文字列がのらなくなりました。こちらのページでは、リファラにクエリ文字列を付与するために敢えてmeta要素にてリファラポリシーを以下のように変更しています。
</p>
<pre>
&lt;meta name="referrer" content="unsafe-url"&gt;
</pre>
参考
<ul>
<li><a href="https://developer.mozilla.org/ja/docs/Web/HTTP/Headers/Referrer-Policy">リファラポリシー|MDN</a></li>
<li><a href="https://blog.mozilla.org/security/2021/03/22/firefox-87-trims-http-referrers-by-default-to-protect-user-privacy/">Firefox 87.0 でのリファラポリシー変更のアナウンス（英文）</a></li>
</ul>
</body>
