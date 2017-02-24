# Protmusis


## Diegimo instrukcija

0. Serveryje turėtų būti įdiegtas http serveris su mysql ir php priedais. Rekomenduojama naudoti LAMP(Linux,Apache,mysql,php) paketą. Detali Lamp paketo diegimo instrukcija Ubuntu 16.04 sistemai (https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)phpMyAdmin diegimo instrukcija Ubuntu 16.04 sistemai
(https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-16-04)
1. Aplanko html turinį perkelti į serverio šakninį aplanką(Ubuntu sistemoje pagal nutylėjimą /var/www/html)
+ Ubuntu sistemojoe šakninis aplankas yra pasiekiamas tik su root privilegijomis todėl norint perkeli html aplanko turinį reiks naudois "sudo cp -a /home/user/downloads/html/. /var/www/html" /home/user/downloads/html/ pakeičiant nuoroda į html aplanką
.. Naudojant phpmyadmin priedu importuoti į serverį info.sql duomenų bazės šabloną
+ Ubuntu sistemojoe šakninis aplankas yra pasiekiamas tik su root privilegijomis todėl norint perkeli html aplanko turinį reiks naudois "sudo cp -a /home/user/downloads/html/. /var/www/html" /home/user/downloads/html/ pakeičiant nuoroda į html aplanką
