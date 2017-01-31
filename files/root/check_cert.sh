#!/usr/bin/env bash

web_service='nginx'
domain='topditop.com'
webroot_path=/var/www/html/public

config_file=/usr/local/etc/le-config.ini

if [ ! -f $config_file ]; then
    echo "[ERROR] config file does not exist: $config_file"
    exit 1;
fi

exp_limit=30;

cert_file="/etc/letsencrypt/live/$domain/fullchain.pem"
key_file="/etc/letsencrypt/live/$domain/privkey.pem"

if [ ! -f $cert_file ]; then

    echo "Certificate file not found for domain $domain."
    echo "Creating new certificate..."

    echo "Stopping $web_service"
	supervisorctl stop nginx

    certbot-auto certonly --agree-tos --noninteractive --standalone --config $config_file

    echo "Certificate created."

    echo "Start $web_service"
	supervisorctl start nginx

    exit 0;
fi

exp=$(date -d "`openssl x509 -in $cert_file -text -noout|grep "Not After"|cut -c 25-`" +%s)
datenow=$(date -d "now" +%s)
days_exp=$(echo \( $exp - $datenow \) / 86400 |bc)

echo "Checking expiration date for $domain..."

if [ "$days_exp" -gt "$exp_limit" ] ; then
	echo "The certificate is up to date, no need for renewal ($days_exp days left)."
	exit 0;
else

	echo "The certificate for $domain is about to expire soon. Starting Let's Encrypt renewal script..."
	certbot-auto certonly --webroot --agree-tos --renew-by-default --webroot-path=$webroot_path --config $config_file

	echo "Reloading $web_service"
	supervisorctl restart nginx
	echo "Renewal process finished for domain $domain"
	exit 0;
fi