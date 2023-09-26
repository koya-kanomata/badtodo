FROM tomcat:8.5.82-jre8-openjdk-slim-bullseye

# 以下はデバッグ用ツールのインストール（本番では必要なし）
# RUN  apt update \
#  && apt install -y vim-tiny less iputils-ping net-tools procps
# デバッグ用終わり

COPY commons-lang3.jar $CATALINA_HOME/lib/
COPY wasbook.war $CATALINA_HOME/webapps/ROOT.war
