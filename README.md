# Touche pas au klaxon

Application web de covoiturage interne destinée aux employés d’une entreprise multi-sites.

## Description

Cette application permet de :
- Consulter les trajets proposés (avec places disponibles)
- Se connecter
- Proposer un trajet
- Modifier / supprimer ses propres trajets
- Consulter les détails d’un trajet (fenêtre modale)
- Administrer les utilisateurs, agences et trajets (compte administrateur)

## Technologies utilisées

- PHP 8.1+
- Architecture MVC
- MySQL / MariaDB
- Routeur : izniburak/router
- Bootstrap 5 + Sass
- PHPUnit
- PHPStan

## Prérequis

- PHP >= 8.1
- Composer
- MySQL ou MariaDB
- Node.js + npm (pour compiler le Sass)

## Installation

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd touche-pas-klaxon
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances front (Bootstrap + Sass)

```bash
npm install
```

### 4. Configurer la base de données

Ouvrir le fichier `config/database.php` et renseigner les identifiants :

```php
return [
    'host'     => 'localhost',
    'dbname'   => 'touche_pas_klaxon',
    'user'     => 'root',
    'password' => '',
    'charset'  => 'utf8mb4'
];
```

### 5. Créer et alimenter la base de données

Exécuter les scripts SQL dans l’ordre :
1. `sql/Script-create.sql` (création des tables)
2. `sql/Script-data.sql` (données de test)

### 6. Compiler le CSS (Sass)

```bash
npx sass public/assets/css/style.scss public/assets/css/style.css
```

### 7. Lancer l’application

```bash
php -S localhost:8000 -t public
```

Ouvrir ensuite dans le navigateur : http://localhost:8000

## Comptes de test

| Rôle        | Email                          | Mot de passe |
|-------------|--------------------------------|--------------|
| Utilisateur | alexandre.martin@email.fr     | password     |
| Admin       | admin@email.fr                | password     |


