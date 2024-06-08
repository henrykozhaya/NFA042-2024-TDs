# Upload de fichier CSV et insertion de toutes les données dans une base de données MySQL

## Base de données
Créer une nouvelle base de données nommée note avec un utilisateur ayant les droits `SELECT`, `UPDATE`, `DELETE`, `INSERT`.
Créer les tables suivantes :

* matiere (<ins>id</ins>, description)
* annee (<ins>annee</ins>)
* note (<ins>id</ins>, note, annee, matiereID, eleveID)

Ajouter toutes les requêtes que vous avez utilisées dans un fichier `requetes.sql`.

## Page Web
Créer une page `note.php` qui affiche un formulaire avec les champs suivants :

* Select : Matière (rempli à partir de la base de données)
* Select : Année (rempli à partir de la base de données ; l'année actuelle doit être sélectionnée par défaut)
* Upload de fichier : Notes (le fichier à télécharger doit être au format CSV)

Une fois le formulaire soumis, il faut valider que toutes les données ont été envoyées et que le fichier existe et est de type CSV.
Il faut sauvegarder le fichier dans un dossier appelé notes.
Renommer le fichier en : `notes-{matiere}-{annee}.csv`.
Lire le fichier ligne par ligne et ajouter les notes (avec l'année et la matière) dans la table note de la base de données crées.
N'oubliez pas de valider les entrées.

_Veuillez vérifier le fichier `note-à-télécharger.csv` que vous pouvez utiliser comme exemple_