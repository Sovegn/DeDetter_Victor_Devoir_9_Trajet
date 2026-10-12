<h2 class="mb-4">Tous les trajets</h2>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Départ</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Places</th>
                <th>Auteur</th>
                <th style="width:80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($trajets)): ?>
                <tr>
                    <td colspan="9" class="text-center">Aucun trajet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($trajets as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['agence_depart']) ?></td>
                        <td><?= date('d/m/Y', strtotime($t['date_heure_depart'])) ?></td>
                        <td><?= date('H:i', strtotime($t['date_heure_depart'])) ?></td>
                        <td><?= htmlspecialchars($t['agence_arrivee']) ?></td>
                        <td><?= date('d/m/Y', strtotime($t['date_heure_arrivee'])) ?></td>
                        <td><?= date('H:i', strtotime($t['date_heure_arrivee'])) ?></td>
                        <td><?= $t['places_dispo'] ?> / <?= $t['places_total'] ?></td>
                        <td><?= htmlspecialchars($t['auteur_prenom'] . ' ' . $t['auteur_nom']) ?></td>
                        <td>
                            <form action="/trajet/delete/<?= $t['id_trajet'] ?>" method="post"
                                  onsubmit="return confirm('Supprimer ce trajet ?')">
                                <button class="btn btn-sm btn-outline-danger">🗑</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a href="/admin" class="btn btn-outline-secondary">← Retour</a>