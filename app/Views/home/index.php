<?php if (empty($_SESSION['user'])): ?>
    <p class="text-center mb-3">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</p>
<?php endif; ?>

<h2 class="mb-4">Trajets proposés</h2>

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
                <?php if (!empty($_SESSION['user'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($trajets)): ?>
                <tr>
                    <td colspan="8" class="text-center">Aucun trajet disponible pour le moment.</td>
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
                        <td><?= $t['places_dispo'] ?></td>

                        <?php if (!empty($_SESSION['user'])): ?>
                            <td class="text-nowrap">
                                <!-- Bouton détails (modal) -->
                                <button class="btn btn-sm btn-outline-secondary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modal<?= $t['id_trajet'] ?>">
                                    👁
                                </button>

                                <?php if ($t['id_utilisateur'] == $_SESSION['user']['id'] || $_SESSION['user']['role'] === 'admin'): ?>
                                    <a href="/trajet/edit/<?= $t['id_trajet'] ?>" class="btn btn-sm btn-outline-primary">✏</a>
                                    <form action="/trajet/delete/<?= $t['id_trajet'] ?>" method="post" class="d-inline" 
                                          onsubmit="return confirm('Supprimer ce trajet ?')">
                                        <button class="btn btn-sm btn-outline-danger">🗑</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <!-- Modal détails -->
                    <div class="modal fade" id="modal<?= $t['id_trajet'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Détails du trajet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Auteur :</strong> <?= htmlspecialchars($t['auteur_prenom'] . ' ' . $t['auteur_nom']) ?></p>
                                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($t['auteur_tel']) ?></p>
                                    <p><strong>Email :</strong> <?= htmlspecialchars($t['auteur_email']) ?></p>
                                    <p><strong>Nombre total de places :</strong> <?= $t['places_total'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>