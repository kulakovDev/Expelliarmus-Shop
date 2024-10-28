FROM node:18

RUN mkdir -p /var/www/expelliarmus/frontend

WORKDIR /var/www/expelliarmus/frontend

RUN mkdir -p /var/www/expelliarmus/frontend/.npm

RUN npm config set cache /var/www/expelliarmus/frontend/.npm --global
