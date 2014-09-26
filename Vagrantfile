VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    config.vm.box = "lamp-vm-v0.2.15"
    config.vm.hostname = "abc.example.net"

    require 'ffi'

    if FFI::Platform::IS_WINDOWS
        print "\n\n   ===> win\n\n"
        config.vm.synced_folder ".", "/vagrant", :nfs => false
        config.vm.network :forwarded_port, guest: 80, host: 8080
    else
        print "\n\n   ===> not win\n\n"
        config.vm.network :private_network, ip: "33.33.33.10"
        config.vm.synced_folder ".", "/vagrant", :nfs => true
    end

end
