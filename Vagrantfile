# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.provision "shell", inline: "echo Hello"

  config.vm.define :web do |web_config|
    web_config.vm.box = "centos/7"
    web_config.vm.host_name = "web"
    web_config.vm.network "private_network", ip:"192.168.100.10"
    web_config.vm.network :public_network, :bridge => 'virbr2', :dev => 'virbr2'
    web_config.vm.provider :virtualbox do |vb|
        vb.customize ["modifyvm", :id, "--memory", "512"]
        vb.customize ["modifyvm", :id, "--cpus", "1"]
    
    end
    web_config.vm.provision "shell", inline: <<-SHELL
    yum update
    yum install epel-release -y
    sudo yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm -y
    sudo yum install yum-utils -y
    sudo yum-config-manager --enable remi-php72
    sudo yum update
    sudo yum install php72 -y
    sudo yum install php72-php-fpm php72-php-gd php72-php-json php72-php-mbstring php72-php-mysqlnd php72-php-xml php72-php-xmlrpc php72-php-opcache -y
    sudo systemctl enable php72-php-fpm.service
    sudo systemctl start php72-php-fpm.service
    sudo yum install ansible -y
    yum install mariadb -y
    sudo systemctl enable nginx
    sudo systemctl start nginx
SHELL
  end
    config.vm.provision "ansible" do |ansible|
    ansible.playbook = "web.yml"
    end

config.vm.define :db do |db_config|
    db_config.vm.box = "centos/7"
    db_config.vm.host_name = "db"
    db_config.vm.network "private_network", ip:"192.168.100.20"
    db_config.vm.network :public_network, :bridge => 'virbr2', :dev => 'virbr2'
    db_config.vm.provider :virtualbox do |vb|
        vb.customize ["modifyvm", :id, "--memory", "1024"]
        vb.customize ["modifyvm", :id, "--cpus", "1"]
    end
    db_config.vm.provision "shell", inline: <<-SHELL
    yum update
    yum install mariadb-server mariadb-client ansible -y
    systemctl start mariadb
    systemctl enable mariadb
SHELL
end
    #config.vm.provision :ansible do |ansible|
    #ansible.playbook = "db.yml"
    #end

  # Example configuration of new VM..
  # 
  #config.vm.define :test_vm do |test_vm|
    # Box name
    #
    #test_vm.vm.box = "centos64"

    # Domain Specific Options
    #
    # See README for more info.
    #
    #test_vm.vm.provider :libvirt do |domain|
    #  domain.memory = 2048
    #  domain.cpus = 2
    #end

    # Interfaces for VM
    # 
    # Networking features in the form of `config.vm.network`
    #
    #test_vm.vm.network :private_network, :ip => '10.20.30.40'
    #test_vm.vm.network :public_network, :ip => '10.20.30.41'
  #end

  # Options for Libvirt Vagrant provider.
  config.vm.provider :libvirt do |libvirt|

    # A hypervisor name to access. Different drivers can be specified, but
    # this version of provider creates KVM machines only. Some examples of
    # drivers are KVM (QEMU hardware accelerated), QEMU (QEMU emulated),
    # Xen (Xen hypervisor), lxc (Linux Containers),
    # esx (VMware ESX), vmwarews (VMware Workstation) and more. Refer to
    # documentation for available drivers (http://libvirt.org/drivers.html).
    libvirt.driver = "kvm"

    # The name of the server, where Libvirtd is running.
    # libvirt.host = "localhost"

    # If use ssh tunnel to connect to Libvirt.
    libvirt.connect_via_ssh = false

    # The username and password to access Libvirt. Password is not used when
    # connecting via ssh.
    libvirt.username = "root"
    #libvirt.password = "secret"

    # Libvirt storage pool name, where box image and instance snapshots will
    # be stored.
    libvirt.storage_pool_name = "default"

    # Set a prefix for the machines that's different than the project dir name.
    #libvirt.default_prefix = ''
  end
end
