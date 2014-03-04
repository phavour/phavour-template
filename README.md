Phavour Skeleton & Documentation
================================

This repository serves as a quick start to getting started with Phavour. It also holds the documentation.

## Getting Started

To get the Phavour-Template application running, you need to perform the following steps:

1. Symlink (or copy) `Vagrantfile.dist` to `Vagrantfile`
2. Symlink (or copy) `index.dist.php` to `index.php`
3. Run `composer install`
4. Run `vagrant up`

### Please Be Aware

- If you don't symlink (or copy) `index.dist.php` to `index.php`, Nginx will return a **HTTP 403** status code as the index directive file, `index.php`, isn't available.

## The Virtual Machine

Please make sure that you have a copy of the latest versions of both [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads) installed.

The virtual machine which will be provisioned, is based off of [Ubuntu Precise64](http://releases.ubuntu.com/12.04.4/). If you don't already have a Precise64 box downloaded, one will be downloaded automatically and then provisioned.

When fully provisioned, the virtual machine will contain the following packages:

- vim
- curl
- python
- nginx
- memcached

PHP will be installed via `php5-fpm` and will have the **Memcache** and **APC** extensions available, configured and enabled.

The virtual machine will be configured with port 80 forwarding to port 8080 on your local machine. The directory which you cloned `phavour-template` to, by default, `phavour-template`, will be available as `/vagrant` in the virtual machine, with the `web` directory symlinked to `/var/www`.