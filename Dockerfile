FROM centos

MAINTAINER hato6502

RUN yum install -y httpd
RUN yum install -y http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN yum install -y --enablerepo=remi-php72 php php-mbstring

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
