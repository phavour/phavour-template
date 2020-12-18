#!/usr/bin/env bash

echo "Beginning provisioning"
if ! grep -q "ubuntu-xenial" /etc/hosts; then
    echo "127.0.0.1 ubuntu-xenial" >> /etc/hosts
fi

apt-get update

add-apt-repository ppa:ondrej/php
add-apt-repository ppa:ondrej/nginx

apt-get update
apt-get upgrade -y
apt-get install -y --allow-unauthenticated zip unzip nginx git curl language-pack-en memcached \
  php7.2-fpm php7.2 php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-curl \
  php7.2-intl php7.2-fileinfo php7.2-json php7.2-mbstring php7.2-opcache php7.2-soap php7.2-sqlite3 \
  php7.2-xml php7.2-xsl php7.2-gd php7.2-zip php-memcache \
  php7.2-memcached
apt-get update
apt-get upgrade -y

sed -i -e 's/session.gc_maxlifetime = 1440/session.gc_maxlifetime = 31536000/g' /etc/php/7.2/fpm/php.ini
sed -i -e 's/session.cookie_lifetime = 0/session.cookie_lifetime = 31536000/g' /etc/php/7.2/fpm/php.ini
sed -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 30M/g' /etc/php/7.2/fpm/php.ini
sed -i -e 's/post_max_size = 8M/post_max_size = 30M/g' /etc/php/7.2/fpm/php.ini

service php7.2-fpm stop
service nginx stop

echo "Configuring nginx"
rm -rf /var/www
ln -s /vagrant/web /var/www

if [ -f "/etc/nginx/sites-enabled/default" ]; then
  rm /etc/nginx/sites-enabled/default
fi

cp /vagrant/nginx.conf /etc/nginx/sites-enabled/vagrant-site

service nginx start
service php7.2-fpm start

if [[ -e /usr/local/bin/composer ]]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi
sleep 2
if [[ -e /var/www/html ]]; then
    rm -rf /var/www/html
fi

usermod -a -G vagrant www-data

service php7.2-fpm restart
service nginx restart
