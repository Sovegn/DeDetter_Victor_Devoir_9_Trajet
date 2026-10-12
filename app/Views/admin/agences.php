<h2 class="mb-4">Gestion des agences</h2>

<!-- Formulaire d'ajout -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Ajouter une agence</h5>
        <form method="post" action="/admin/agences/create" class="row g-2">
            <div class="col-auto">
                <input type="text" name="nom" class="form-control" placeholder="Nom de la ville" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-dark">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Liste des agences -->
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th style="width:100px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agences as $a): ?>
                <tr>
                    <td><?= $a['id_agence'] ?></td>
                    <td><?= htmlspecialchars($a['nom']) ?></td>
                    <td>
                        <form action="/admin/agences/delete/<?= $a['id_agence'] ?>" method="post"
                              onsubmit="return confirm('Supprimer cette agence ?')">
                            <button class="btn btn-sm btn-outline-danger">🗑</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="/admin" class="btn btn-outline-secondary">← Retour</a>