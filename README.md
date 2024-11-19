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
A minima, chaque requête peut prendre ces deux paramètres dans le body : 
```json 
{
    "endpoint" : "Saisir l'endpoint de la requête (par exemple 'auth' ou 'user' sont possibles pour le UserService",
    "urlParameter": "S'il y a un paramètre d'url à passer, par exemple {id} sur la route pour update un utilisateur"
}
```

Pour connaitre les différents endpoints disponibles, lire la documentationd des différents services.

#### Pour utiliser le UserService : 
Une requête doit être envoyée à http://localhost:8001/gateway/userservice.  
Dans le body, les paramètres suivants sont possibles : 
```json 
{
    "id": int,
    "username": string,
    "password": string,
    "role": string
}
```
