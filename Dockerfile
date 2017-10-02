FROM centos:7
MAINTAINER "harupu"
RUN yum -y update
RUN yum install -y php php-pdo php-mysql mariadb-server httpd
RUN systemctl enable mariadb.service
RUN systemctl enable httpd.service
COPY files/html/* /var/www/html/
COPY files/init.sh /root/init.sh
COPY files/sql.db /root/sql.db
COPY files/my.cnf /etc/my.cnf
RUN chmod 755 /root/init.sh
RUN echo "/root/init.sh" >> /etc/rc.d/rc.local
RUN chmod 755 /etc/rc.d/rc.local
EXPOSE 80
CMD ["/sbin/init"]
