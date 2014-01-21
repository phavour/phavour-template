#!/usr/bin/env bash

echo "Beginning provisioning"
sudo apt-get update
export LANGUAGE=en_GB.UTF-8
export LANG=en_GB.UTF-8
export LC_ALL=en_GB.UTF-8
locale-gen en_GB.UTF-8
sudo dpkg-reconfigure locales
sudo apt-get install -y vim curl python-software-properties
sudo apt-get install -y nginx php5-fpm
sudo apt-get install -y php5-memcache memcached php-apc

echo "Configuring nginx"
sudo rm -rf /var/www
sudo ln -s /vagrant/web /var/www
sudo rm /etc/nginx/sites-enabled/default
cat << EOF | sudo tee -a /etc/nginx/sites-enabled/vagrant-site
server {
    listen *:80;
    root /var/www;
    index index.php;
    try_files \$uri \$uri/ /index.php?\$query_string;
    sendfile off;
    location ~ ^/index\.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
    }
}
EOF

sudo service nginx restart
sudo service php5-fpm restart


