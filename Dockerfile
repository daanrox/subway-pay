FROM alpine:3.20 AS production

CMD [ "/usr/sbin/httpd", "-DFOREGROUND" ]

EXPOSE 80

RUN apk add php83-apache2 php83-mysqli php83-session && \
    rm /var/www/localhost/htdocs/index.html

COPY ./_next /var/www/localhost/htdocs/_next

COPY ./.well-known /var/www/localhost/htdocs/.well-known

COPY ./adm /var/www/localhost/htdocs/adm

COPY ./afiliate /var/www/localhost/htdocs/afiliate

COPY ./arquivos /var/www/localhost/htdocs/arquivos

COPY ./auth /var/www/localhost/htdocs/auth

COPY ./cadastrar /var/www/localhost/htdocs/cadastrar

COPY ./cronjobs /var/www/localhost/htdocs/cronjobs

COPY ./demo /var/www/localhost/htdocs/demo

COPY ./deposito /var/www/localhost/htdocs/deposito

COPY ./enddemo /var/www/localhost/htdocs/enddemo

COPY ./game /var/www/localhost/htdocs/game

COPY ./gameover /var/www/localhost/htdocs/gameover

COPY ./img /var/www/localhost/htdocs/img

COPY ./influencer /var/www/localhost/htdocs/influencer

COPY ./jogar /var/www/localhost/htdocs/jogar

COPY ./legal /var/www/localhost/htdocs/legal

COPY ./login /var/www/localhost/htdocs/login

COPY ./obrigado /var/www/localhost/htdocs/obrigado

COPY ./painel /var/www/localhost/htdocs/painel

COPY ./play /var/www/localhost/htdocs/play

COPY ./presell /var/www/localhost/htdocs/presell

COPY ./saque /var/www/localhost/htdocs/saque

COPY ./saque-afiliado /var/www/localhost/htdocs/saque-afiliado

COPY ./webhook /var/www/localhost/htdocs/webhook 

COPY ./.ftpquota ./.htaccess ./*.jpg ./*.php ./*.png ./*.sql /var/www/localhost/htdocs/
