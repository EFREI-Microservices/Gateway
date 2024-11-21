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

3. Lancer le serveur
```bash
npm run start
```

Le gateway est disponible à l'adresse `http://localhost:8001`.  
⚠️ Les microservices doivent être démarrés pour que le gateway fonctionne entièrement.

## Utiliser l'API Gateway

Chaque requête peut comporter le token JWT dans le header si la route a besoin d'authentification.   

Pour connaitre les différents endpoints disponibles, lire la documentation des différents services.

### 1. Pour utiliser le `UserService` : 
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/UserService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/userservice/{endpoint}`.  
Si souhaité, on peut passer l'id d'un utilisateur en paramètre : `http://localhost:8001/userservice/{endpoint}/{id}`.  
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

#### ℹ️ Exemple d'utilisation
Exemple pour PATCH un utilisateur sans modifier le mot de passe :  
Route : `http://localhost:8001/userservice/user/idutilisateur123456`  
Méthode : `PATCH`  
Headers (Authorization) : `Bearer exampletoken123456`  
Body :  
```json
{
    "username": "newUsername",
    "role": "admin"
}
```

### 2. Pour utiliser le `ProductService` :
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/ProductService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/productservice/`.  
Si souhaité, on peut passer l'id d'un produit en paramètre : `http://localhost:8001/productservice/{id}`.  
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "name": string,
    "description": string,
    "price": int,
    "available": bool
}
```

#### ℹ️ Exemple d'utilisation
Exemple pour voir tous les produits :  
Route : `http://localhost:8001/productservice`  
Méthode : `GET`  
Headers (Authorization) : Aucun  
Body : Aucun

### 3. Pour utiliser le `BasketService` :
[Lien vers les endpoints détaillés](https://github.com/EFREI-Microservices/BasketService?tab=readme-ov-file#endpoints)  
Une requête doit être envoyée à `http://localhost:8001/basketservice/{endpoint}`.
Dans le body, les paramètres suivants sont acceptés : 
```json 
{
    "productId": int,
    "quantity": int
}
```

#### ℹ️ Exemple d'utilisation
Exemple pour ajouter 5 produits avec l'id `47` au panier de l'utilisateur authentifié :  
Route : `http://localhost:8001/basketservice/add`  
Méthode : `POST`  
Headers (Authorization) : `Bearer exampletoken123456`  
Body :  
```json
{
    "productId": 47,
    "quantity": 5
}
```

## Ajouter un microservice au gateway en 5 minutes chrono

Pour ajouter une service au gateway, suivre les étapes suivantes :

#### 1. Créer un `RequestData` :  
Ajouter votre `XxxRequestData` dans `src/Simple/RequestData/` et extends `AbstractRequestData`.  
Dans celui-ci, ajoutez les propriétées liées à votre microservice.  

#### 2. Créer un `ServiceFetcher`
Ajouter votre `XxxServiceFetcher` dans `src/ServiceFetcher/` et extends `AbstractServiceFetcher`.  
Dans celui-ci, vous devez implémenter la méthode `getRoute()` qui gère la logique de routing en fonction de votre microservice.  
Enfin, ajouter votre nouveau `ServiceFetcher` dans le `ServiceFetcherFacade` pour pouvoir le récupérer depuis votre controller `$this->serviceFetcherFacade->getXxxServiceFetcher`.  

#### 3. Créer un controlleur
Ajouter un controlleur qui extends `AbstractGatewayController` et implémenter la fonction `index()`.  
La route index de ce nouveau controlleur doit retourner `return $this->manageRequest($requestData $serviceFetcher)`.  
