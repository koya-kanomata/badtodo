#!/bin/sh
sleep 5
nc localhost 25 <<EOF
HELO example.jp
MAIL FROM:tokumaru@example.jp
RCPT TO:wasbook@example.jp
DATA
To: wasbook@example.jp
From: tokumaru <tokumaru@example.jp>
Subject: =?UTF-8?Q?=E4=BD=93=E7=B3=BB=E7=9A=84=E3=81=AB=E5=AD=A6=E3=81=B6?=  =?UTF-8?Q?=E5=AE=89=E5=85=A8=E3=81=AAWeb=E3=82=A2=E3=83=97=E3=83=AA?=  =?UTF-8?Q?=E3=82=B1=E3=83=BC=E3=82=B7=E3=83=A7=E3=83=B3=E3=81=AE=E4=BD=9C?=  =?UTF-8?Q?=E3=82=8A=E6=96=B9_=E7=AC=AC2=E7=89=88=E3=81=AB=E3=82=88?=  =?UTF-8?Q?=E3=81=86=E3=81=93=E3=81=9D?=
Content-Type: text/plain; charset=UTF-8;
Date: Tue, 12 Jun 2018 19:39:15 +0900

読者各位

こんにちは。筆者の徳丸です。
このたびは「体系的に学ぶ 安全なWebアプリケーションの作り方 第2版 ～脆弱
性が生まれる原理と対策の実践～」をご購入いただきありがとうございます。

このメールをお読みいただいているということは、仮想マシンのセットアップが
順調に進んでいることを意味します。本書の実習環境にようこそ。

以下のURLから、脆弱性サンプルのメニューが表示されますので、書籍を読みな
がら色々試してみてください。

http://example.jp/

この環境を活用して、脆弱性と安全なアプリケーションの作り方に対する理解を
深めていただければ幸いです。
ありがとうございました。

徳丸 浩
.
EOF
