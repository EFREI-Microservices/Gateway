# Gateway

Ceci est une courte documentation du gateway pour le projet final de Microservices.  

## Prérequis
- Composer 2.7 or above [\<link\>](https://getcomposer.org/doc/00-intro.md)
- Node [\<link\>](https://nodejs.org/en/download/)
- PHP 8.2 or above [\<link\>](https://www.php.net/downloads)
- Docker 27 or above [\<link\>](https://docs.docker.com/get-docker/)

## Installation

1. Clone le repository
```bash
git clone https://github.com/EFREI-Microservices/ProductService.git
```
2. Installer les dépendances
```bash
composer install
```

3. Lancer la base de données
```bash
docker-compose up -d
```

4. Générer les données de test
```bash
npm run truncate-database
```

5. Lancer le serveur
```bash
npm run start
```

Le gateway est disponible à l'adresse `http://localhost:8001`
Les microservices doivent être lancés pour que le gateway fonctionne.

## Comment l'utiliser

Chaque requête peut comporter le token JWT dans le header si la route a besoin d'authentification
ATTENTION : a minima, chaque requête doit prendre ce paramètre dans le body : 
```json 
{
    "endpoint" : "Saisir l'endpoint de la requête (par exemple 'auth' ou 'user' sont possibles pour le UserService",
}
```

Pour connaitre les différents endpoints disponibles, lire la documentationd des différents services.

#### Pour utiliser le UserService : 
Une requête doit être envoyée à `http://localhost:8001/gateway/userservice`.  
Si souhaité, on peut passer l'id d'un utilisateur en paramètre : `http://localhost:8001/gateway/userservice/idutilisateur`  
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "id": int,
    "username": string,
    "password": string,
    "role": string
}
```

Pour le paramètre `endpoint`, les valeurs possibles sont :
- `register` : pour accéder à la route d'inscription
- `login` : pour accéder à la route de connexion
- `check-token` : pour vérifier la validité du token
- `user` : pour les autres routes liées aux comptes utilisateurs