#!/bin/bash

# Enable and start the nginx service
sudo systemctl enable nginx
sudo systemctl start nginx

# Display a message
echo "Nginx service enabled and started successfully."
