FROM mariadb:10.6
COPY my.conf /etc/mysql/conf.d/
COPY create-tables.sql /docker-entrypoint-initdb.d/
