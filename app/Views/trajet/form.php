<h2 class="mb-4"><?= $trajet ? 'Modifier le trajet' : 'Créer un trajet' ?></h2>

<!-- Infos utilisateur (non modifiables) -->
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-title">Vos informations</h6>
        <p class="mb-1"><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
        <p class="mb-1"><strong>Prénom :</strong> <?= htmlspecialchars($_SESSION['user']['prenom']) ?></p>
        <p class="mb-1"><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
        <p class="mb-0"><strong>Téléphone :</strong> (visible dans les détails du trajet)</p>
    </div>
</div>

<form method="post" action="<?= $action ?>">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Agence de départ</label>
            <select name="id_agence_depart" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agence'] ?>"
                        <?= ($trajet['id_agence_depart'] ?? '') == $a['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Agence d'arrivée</label>
            <select name="id_agence_arrivee" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $a): ?>
                    <option value="<?= $a['id_agence'] ?>"
                        <?= ($trajet['id_agence_arrivee'] ?? '') == $a['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Date et heure de départ</label>
            <input type="datetime-local" name="date_heure_depart" class="form-control"
                   value="<?= $trajet ? date('Y-m-d\TH:i', strtotime($trajet['date_heure_depart'])) : '' ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date et heure d'arrivée</label>
            <input type="datetime-local" name="date_heure_arrivee" class="form-control"
                   value="<?= $trajet ? date('Y-m-d\TH:i', strtotime($trajet['date_heure_arrivee'])) : '' ?>" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Nombre total de places</label>
        <input type="number" name="places_total" class="form-control" min="1"
               value="<?= $trajet['places_total'] ?? 4 ?>" required>
    </div>

    <button type="submit" class="btn btn-dark">
        <?= $trajet ? 'Modifier' : 'Créer' ?>
    </button>
    <a href="/" class="btn btn-outline-secondary">Annuler</a>
</form>