# Gateway

Ceci est une courte documentation du gateway pour le projet final de Microservices.  

## Prérequis
- Composer 2.7 or above [\<link\>](https://getcomposer.org/doc/00-intro.md)
- Node [\<link\>](https://nodejs.org/en/download/)
- PHP 8.2 or above [\<link\>](https://www.php.net/downloads)
- Docker 27 or above [\<link\>](https://docs.docker.com/get-docker/)

## Installation

1. Cloner le repository
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

Chaque requête peut comporter le token JWT dans le header si la route a besoin d'authentification.   

Pour connaitre les différents endpoints disponibles, lire la documentation des différents services.

### 1. Pour utiliser le `UserService` : 
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/UserService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/gateway/userservice/{endpoint}`.  
Si souhaité, on peut passer l'id d'un utilisateur en paramètre : `http://localhost:8001/gateway/userservice/{endpoint}/{id}`.  
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "username": string,
    "password": string,
    "role": string
}
```

Pour le paramètre URL `endpoint`, les valeurs possibles sont :
- [POST] `register` : pour accéder à la route d'inscription
- [POST] `login` : pour accéder à la route de connexion
- [GET] `check-token` : pour vérifier la validité du token
- [GET | PATCH | DELETE] `user` : pour les autres routes liées aux comptes utilisateurs

### 2. Pour utiliser le `ProductService` :
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/ProductService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/gateway/productservice/`.  
Si souhaité, on peut passer l'id d'un produit en paramètre : `http://localhost:8001/gateway/productservice/{id}`.  
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "name": string,
    "description": string,
    "price": int,
    "available": bool
}
```

### 3. Pour utiliser le `BasketService` :
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/UserService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/gateway/basketservice/`.
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "productId": int,
    "quantity": int
}
``` 
