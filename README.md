# Protmusis

Ši sistema sukurta Švenčionėlių Mindaugo gimnazijos protmušio turnyrui, kaip iššukis sau ir kaip dovana gimnazijai.

## Diegimo instrukcija

0. Serveryje turėtų būti įdiegtas http serveris su mysql ir php priedais. Rekomenduojama naudoti LAMP(Linux,Apache,mysql,php) paketą.
 * Detali Lamp paketo diegimo instrukcija Ubuntu 16.04 sistemai. (https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-0).
1. Aplanko html turinį perkelti į serverio šakninį aplanką(Ubuntu sistemoje pagal nutylėjimą /var/www/html).
 * Ubuntu sistemojoe šakninis aplankas yra pasiekiamas tik su root privilegijomis todėl norint perkeli html aplanko turinį reiks naudois "sudo cp -a \<html aplanko nuoroda>. /var/www/html" (pvz "sudo cp -a /home/user/downloads/html/. /var/www/html").
2. Naudojant phpmyadmin priedą importuoti į serverį info.sql duomenų bazės šabloną.
  * Viršutinėje meniu juostoje pasirinkus importuoti ir parsirinkus Info.sql failą pamygti importuoti.
  * phpMyAdmin diegimo instrukcija Ubuntu 16.04 sistemai. (https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-16-04).

## Pasiruošimas protmušiui

* Į Klausimai_Testas, Klausimai_Zodziu ir Klausimai_Vaizdo lenteles atitinkamai įrašomi testinai, atviri ir vaizdo klausimai.
 * Rekomenduojama klausimus kelti naudojant specializuotą duomenų bazių valdymo programą (pvz. „LibreOffice Base“ arba „Ms Office Access“)
* Prisijungus prie administratoriaus sistemos (http://\<serverio domenas>/Admin) ir įėjus į Dalyvių registracijos puslapį suregistruojami dalyviai.
 * papildomi administratoriai registruojami per phpMyAdmin sistemą papildomai pridedant jų prisijungimo vardą į Info.Admins lentelę.

## Protmušio eiga

1. Dalyviai prisijungę prie dalyvio paskyros (http://\<serverio domenas>) laukia kol bus leista pateikti atsakymus.
2. Protmušio vyr. administratorius (root) prisijungęs prie administratoriaus sistemos (http://\<serverio domenas>/Admin) ir įėjus į pagr. konsolės puslapį pasirenka klausimo numerį ir tipą bei paspaudžia mygtuką „pateikti“.
 * Pakeitus klausimo tipą patartina klausimo numerį parikti '0'. jis yra bandomasis ir jis nebus siunčiamas
3. Dalyviai pasirenka (testinėje dalyje) arba įrašo (atvrų ir vaizdo klausimų dalyje) atsakymą bei paspaudžia pateikti (**išjungus puslapį klausimas neišsisaugo**)
4. Po sutarto laiko tarpo vyr. administratorius sustabto atsakymų teikimą paspaustamas mygtuką „Užbaigti klausimą/pasirinkti naują klausimą“ (**iki to laiko nespėjus pateikti atsakymo automatiškai pateikiamas paskutinis pasirinktas ar iki to laiko surinktas ataskymas**)
5. Teisėjai, prisijungę prie administratorius sistemos ir įsijungę teisėjų prieigos puslapį gali tikrinti pateiktus atvirų ir vaizdo klausimų atsakymus.
6. Komandų rezultatus galima rasti administratorius sistemos rezultatų puslapyje.

Kilus klausimams rašykite karolis.breidokas\<at>ktu.edu
