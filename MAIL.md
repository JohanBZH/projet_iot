Required :
- phpMailer
    - installer avec composer
    composer require phpmailer/phpmailer
- MailHog (simuler un SMTP en local pour vérifier si l'envoi de mail fonctionne - https://kinsta.com/blog/mailhog/#what-is-mailhog)
    - essayer de faire fonctionner avec docker (sinon nécessite d'utiliser golang- problèmes de version avec ubuntu)
    docker pull mailhog/mailhog
docker run -d -p 1025:1025 -p 8025:8025 --name mailhog mailhog/mailhog

et accès sur http://localhost:8025/



sudo tail -f /var/log/apache2/error.log
