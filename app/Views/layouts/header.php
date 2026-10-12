<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche pas au klaxon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #0074c7;
            --bs-secondary: #00497c;
            --bs-danger: #cd2c2e;
            --bs-success: #82b864;
            --bs-body-bg: #f1f8fc;
            --bs-dark: #384050;
        }
        body { background-color: #f1f8fc; }
        .navbar-custom {
            background: white;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .btn-dark { background-color: #384050; border: none; }
        .btn-dark:hover { background-color: #2c3340; }
        .table thead th { background-color: #384050 !important; color: white; }
    </style>
</head>
<body>
<nav class="container mt-3">
    <div class="navbar-custom d-flex justify-content-between align-items-center">
        <a href="/" class="text-decoration-none fw-bold text-dark">Touche pas au klaxon</a>
        <div class="d-flex align-items-center gap-2">
            <?php if (!empty($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/admin/utilisateurs" class="btn btn-secondary btn-sm">Utilisateurs</a>
                    <a href="/admin/agences" class="btn btn-secondary btn-sm">Agences</a>
                    <a href="/admin/trajets" class="btn btn-secondary btn-sm">Trajets</a>
                <?php else: ?>
                    <a href="/trajet/create" class="btn btn-dark btn-sm">Créer un trajet</a>
                <?php endif; ?>
                <span class="ms-2">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></span>
                <a href="/logout" class="btn btn-dark btn-sm">Déconnexion</a>
            <?php else: ?>
                <a href="/login" class="btn btn-dark btn-sm">Connexion</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['flash']['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>