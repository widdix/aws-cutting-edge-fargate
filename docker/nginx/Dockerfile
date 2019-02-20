FROM nginx:1.14

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY --chown=nginx:nginx src/ /var/www/html/
