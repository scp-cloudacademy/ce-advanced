#!/bin/bash

# Add entry to /etc/hosts file
sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'

# Enable and start the php-fpm service
sudo systemctl enable php-fpm
sudo systemctl start php-fpm

# Display a message
echo "Entry added to /etc/hosts, and php-fpm service enabled and started successfully."
