@echo off
REM permet de n'afficher que le r้sultats des commande et pas les commandes
Title gerer la base
REM donne un titre a la fenetre
mode con cols=50 lines=40
REM d้fini les dimentions de la fenetre
:debut
REM d้finit un point de d้part(nous servira เ boucler le programme)
echo ษอออออออออออออออออออออออออออออออออออออออออออออออป
echo บ            gerer la base                      บ
echo บ                                               บ
echo บ            Par   Yohan Marfoq                 บ
echo ฬอออออออออออออออออออออออออออออออออออออออออออออออน
echo บ 1.creer ou reinitialiser la base              บ
echo บ 2.actualiser l'album                          บ
echo บ 3.actualiser les partenaires                  บ
echo บ 4.supprimer tous les commentaires             บ
echo บ 5.supprimer un commentaire                    บ
echo บ 6.modifier les informations d'un partenaire   บ
echo บ 7.sauvegarder la base dans un fichier exel    บ
echo บ 8.entrer une requete directement              บ
echo ศอออออออออออออออออออออออออออออออออออออออออออออออผ
echo.
echo Votre selection ?
set /P choix=




REM choix 1 : cr้er et initialiser la base
if %choix%==1 (
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS reservation(id INTEGER PRIMARY KEY, prenom TEXT, nom TEXT, mail TEXT, adresse TEXT,  datein TEXT, dateout TEXT, nadultes TEXT, nenfants TEXT, prix TEXT, etat TEXT);"
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS photo(id INTEGER PRIMARY KEY, dossier TEXT, adresse TEXT, nom TEXT, description TEXT);"
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS commentaires(id INTEGER PRIMARY KEY, nom TEXT, com TEXT, date DATE);"
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS partenaires(id INTEGER PRIMARY KEY, nom TEXT, logo TEXT, site TEXT, contact TEXT);"
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS messages(id INTEGER PRIMARY KEY, nom TEXT, mail TEXT, sujet TEXT, mess TEXT, date DATE);"
sqlite3 base.bdd "CREATE TABLE IF NOT EXISTS stat(date DATE, page TEXT, ip TEXT);"

sqlite3 base.bdd "DELETE FROM photo;"
sqlite3 base.bdd "DELETE FROM reservation;"
sqlite3 base.bdd "DELETE FROM partenaires;"
sqlite3 base.bdd "DELETE FROM commentaires;"
sqlite3 base.bdd "DELETE FROM messages;"

for /D %%I in (albums/*) do for  %%J in (albums/%%I/*) do sqlite3 base.bdd "INSERT INTO photo(adresse, dossier,nom) VALUES('../bases/albums/%%I/%%J','%%I','%%~nJ');"
for /D %%I in (partenaires/*) do for  %%J in (partenaires/%%I/*) do sqlite3 base.bdd "INSERT INTO partenaires(nom, logo) VALUES('%%I','../bases/partenaires/%%I/%%J');"

goto end
)




REM choix 2 : actualiser la table album
if %choix%==2 (
sqlite3 base.bdd "DELETE FROM photo;"

for /D %%I in (albums/*) do for  %%J in (albums/%%I/*) do sqlite3 base.bdd "INSERT INTO photo(adresse, dossier) VALUES('../bases/albums/%%I/%%J','%%I');"

goto end
)




REM choix 3 : actualise la table partenaire (nom et photo)
if %choix%==3 (
sqlite3 base.bdd "DELETE FROM partenaires;"

for /D %%I in (partenaires/*) do for  %%J in (partenaires/%%I/*) do sqlite3 base.bdd "INSERT INTO partenaires(nom, logo) VALUES('%%I','../bases/partenaires/%%I/%%J');"

goto end
)




REM choix 4 : supprime les commentaires
if %choix%==4 (
sqlite3 base.bdd "DELETE FROM commentaires;"
goto end
)




REM choix 5 : supprime le commentaire d้sign้ 
if %choix%==5 (
echo entrez l'id du commentaire a supprimer

set /P id=

goto supcom
)




REM choix 6 : modifie la table partenaire : contact et site
if %choix%==6 (
echo entrez le nom du partenaire
set /P nompart=

echo voulez modifier le contact ou le site?
set /P attributpart=

echo entrez la valeur de celui-ci
set /P valeurpart=

goto partenaire
)




REM : choix 7 : sauvegarde la base en l'appelant par la date
if %choix%==7 (
sauvegarde.xlsm
)





REM permet d'acceder เ sqlite3
if %choix%==8 (
sqlite3 base.db

goto end
)






:end
exit



:supcom
sqlite3 base.bdd "DELETE FROM commentaires WHERE id='%id%';"
goto end



:partenaire
if %attributpart%==contact (
sqlite3 base.bdd "UPDATE partenaires SET contact='%valeurpart%' WHERE nom='%nompart%';"
)
if %attributpart%==site (
sqlite3 base.bdd "UPDATE partenaires SET site='%valeurpart%' WHERE nom='%nompart%';"
)
goto end


