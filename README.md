# Mock WS Contact Form

## Pré-requis
- Git
- PHP 5.6+
- Composer

## Récupérer le dépôt
```bash
git clone git@github.com:ghrib-aboubaker/mock-form-data.git
```

## Installation des dépendances de l'app
```bash
cd mock-form-data && composer install
```

## Lancer le serveur web
Le serveur web sera accessible par défaut via _localhost:8000_
```bash
bin/console server:run
```
Si besoin de changer par exemple l'IP pour _192.168.0.1_ et/ou le port d'écoute pour le _8080_
```bash
bin/console server:run 192.168.0.1:8080
```

## Récupération des Fake data
GET [http://localhost:8000/fake-data](http://localhost:8000/fake-data)

Ce webservice va retourner des données générées à la volée pour le pré-remplissage du formulaire.

**Attention:** les données peuvent être vides ou faussées intentionnellement afin que le processus de validation 
du formulaire puisse jouer son rôle.

## Soumission du formulaire
POST [http://localhost:8000/post-data](http://localhost:8000/post-data)

Cet endpoint n'est accessible que par la méthode _POST_.

Il accepte les données envoyées par le formulaire avec un de ces 2 formats:
- Les data brutes sous formats JSON avec un header _Content-Type: application/json_
- Les valeurs des champs du formulaires postées directement avec un header _Content-Type: application/x-www-form-urlencoded_

Afin de débuguer ce que reçoit ce webservice :
- Les données reçues sont affichées dans le navigateur
- Un historique de toutes les données réçues se trouve dans _var/logs/posted.data.log_
    