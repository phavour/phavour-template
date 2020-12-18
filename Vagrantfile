# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "forwarded_port", guest: 80, host: 8000
  config.vm.network :forwarded_port, guest: 22, host: 2223, id: "ssh"
  config.vm.provision :shell, path: "provision.sh"
    
  # Share your local Phavour project path with the vagrant image to develop against.
  # The path mounted is "/phavour-core" and on your host the path is "../phavour"
  # Change these to fit your needs.
  # config.vm.synced_folder '../phavour', '/phavour-core', :mount_options => ['dmode=774','fmode=775']

  config.vm.synced_folder '.', '/vagrant', :mount_options => ['dmode=774','fmode=775']
  config.vm.provision :shell, path: "provision.sh"
  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "3072"]
    vb.customize ["modifyvm", :id, "--name", "phavour-template"]
    vb.customize ["modifyvm", :id, "--uartmode1", "disconnected"]
    vb.default_nic_type = "82543GC"
  end
end
