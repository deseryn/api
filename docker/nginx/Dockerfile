FROM nginx:latest

# Copy the nginx configuration file
ADD docker/nginx/default.conf /etc/nginx/conf.d

# Start nginx
CMD ["nginx", "-g", "daemon off;"]