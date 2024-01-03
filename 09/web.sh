#!/bin/bash

# Update the package manager and install yum-utils
sudo yum install yum-utils -y

# Stop the httpd service
sudo systemctl stop httpd

# Change directory to /etc/yum.repos.d and download nginx repository configuration
cd /etc/yum.repos.d
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/nginx.repo

# Install Nginx
sudo yum install nginx -y

# Change directory back to root
cd /

# Download and extract the web content archive
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/web.tar
sudo tar -xvf web.tar

# Set permissions for the web directory
sudo chmod -R 755 /usr/share/nginx/html/web

# Optional: Display a message
echo "Installation completed successfully."
