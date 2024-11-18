# Gateway

Documentation du Gateway

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
