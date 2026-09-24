<?php
require_once __DIR__ . '/../functions/classes.php';

$isHome = false;
$active = 'classes';
include_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createClasses($_POST['nom_classe'], $_POST['annee_scolaire']);
}

if (isset($_GET['delete'])) {
    deleteClasses($_GET['delete']);
}

$classes = getAllClasses();
?>

<main class="container my-4">
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <h1>Classes</h1>

    <form action="classes.php" method="post" class="card card-body mb-4">
        <label for="nom_classe" class="form-label">Nom de la classe :</label>
        <input type="text" name="nom_classe" id="nom_classe" class="form-control">

        <label for="annee_scolaire" class="form-label mt-3">Année scolaire :</label>
        <input type="text" name="annee_scolaire" id="annee_scolaire" class="form-control">

        <input type="submit" value="Ajouter la classe" class="btn btn-primary mt-3">
    </form>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Année scolaire</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $classe) : ?>
                <tr>
                    <td><?= htmlspecialchars($classe['nom']) ?></td>
                    <td><?= htmlspecialchars($classe['annee_scolaire']) ?></td>
                    <td><a href="classes.php?delete=<?= $classe['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
