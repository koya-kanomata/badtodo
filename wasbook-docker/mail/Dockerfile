FROM schickling/mailcatcher
COPY welcome.sh /root/
COPY run.sh /root/
RUN chmod +x /root/*.sh
CMD ["/root/run.sh"]
# CMD mailcatcher --no-quit --foreground --ip=0.0.0.0 --smtp-port=25 --http-port=80 --http-path $HTTPPATH
