# Use the official Nginx image as the base image
FROM nginx

# Download the index.html file from the specified URL and copy it to the Nginx default HTML directory
RUN apt-get update && apt-get install -y wget \
    && wget -O /usr/share/nginx/html/index.html https://raw.githubusercontent.com/scp-cloudacademy/ce-advanced/main/23/index.html \
    && apt-get remove -y wget && apt-get clean && rm -rf /var/lib/apt/lists/*

# Expose port 80
EXPOSE 80
