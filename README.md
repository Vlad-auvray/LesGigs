Les Gigs* (*Petits Boulot), est un modèle de site responsive développé avec PHP, Laravel et requêtes MySQL. 

Le site permet de créer un profil utilisateur permettant de déposer des annonces.
Ce annonces comporte le nom de l'entreprise, du poste, un mail, un lein vers le site du recruteur, des tags et une description. 

Seul l'utilisateur identifié qui a créé des items peut modifier et supprimer ces mêmes items. 

La page inclu une fonction de recherche et de tag. 

Le projet fonctionne par composants (cartes, layout ...), chaque page est nommée de manière conventionnel (ex: "create.blade.php" pour l'affichage du composant de création d'item)

Pour initialiser le projet,télécharger le package puis lancer la commande suivante: php artisan serve 
