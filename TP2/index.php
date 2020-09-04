<!-- Créer une base de données comportant 3 tables.  

Table client :
- Nom - 50 caractères max
- Prénom - 50 caractères max
- Date de naissance - Date
- Adresse - Texte
- Code Postal - 5 caractères max
- Numéro de téléphone - 10 caractères max
- Statut marital - entier

Table statut marital :
- Statut - 50 caractères max

Remplir la table Statut marital avec ces informations :
Statut :       
Célibataire      
Concubinage    
Divorcé     
Marié
Veuf

Table crédit :
- Organisme - 50 caractères max
- Montant - decimal
- Ref client - entier

Créer 4 pages :
- Création client : permettant de créer un client
- Ajout credit : permettant d'ajouter un crédit
- Liste client : permettant de lister les clients
- Détail client : permettant d'afficher les infos clients (info perso, crédits)

Un client peut avoir plusieurs crédits. -->

<?php

// Redirection de l'index vers la page d'accueil "welcome".
header('location:/Controllers/welcomeCtrl.php');