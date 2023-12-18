README
Version php 8.0.1;
- Dans le fichier php.ini, décommentez les lignes (enlever le point-virgule) chargeant les extensions, notamment extension=php_pgsql.dll
- Dans le fichier httpd.conf (Apache), chargez la librairie dynamique avec LoadFile "C:/MAMP/bin/php/php[version]/libpq.dll" (exemple avec MAMP, vérifiez bien le dossier de votre version de PHP)
- Redémarrez le serveur Apache

Dans le fichier "CreationTable" vous trouverez :
- les bases de donnée des objets "BDD_objet" et des utilistateurs "BDD_halloffame"
- les fichiers sql qui permettent de créer ces bases de données 
(PS: Désolé l'exportation avec backup de notre base de donnée n'a pas fonctionée)

Le geoserver:
Il est enregistré dans le dossier worksapce et se nomme projet web
Il faut pour l'utiliser le mettre votre fichier a cette adresse : C:\ProgramData\GeoServer\workspaces
Il est importé dans le fichier maps.js (attention il faudra surement changer le port, nous utilisions le port :8081)



Dérouler du jeux : 
Se rendre en Egypte, il y a trois objet:
Cléopatre est situé a Alexandrie et debloquable grâce au papyrus situé a l'ouest de la ville, le code est 2002.
La carrière de pierres situé a Suez se deploque grâce au gaulois qui sont situé en bretagne nord à Paimpol.
une fois le jeu fini l'alerte apparait et il faut valider sont score pour revenir a l'accueil
