# Configurações (php.ini)
## Ajustes para fazer no php.ini
- session.cookie_secure = 1
- session.cookie_httponly = 1
- session.cookie_samesite = Lax
- session.gc_maxlifetime = 1440

# data.env
## Arquivo com dados de ambiente
## Conteudo:
- DB_HOST=
- DB_USER=
- DB_PASS=
- DB_NAME=

- MAIL_HOST=
- MAIL_PORT=
- MAIL_USERNAME=
- MAIL_PASSWORD=

# COMPOSER
## instalar o composer no ambiente
## instalar o PHPMailer:
- composer require phpmailer/phpmailer