<?php
require_once __DIR__ . '/../functions/cours.php';

$isHome = false;
$active = 'cours';
include_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createCours($_POST['nom_cours'], $_POST['code']);
}

if (isset($_GET['delete'])) {
    deleteCours($_GET['delete']);
}

$cours = getAllCours();
?>

<main class="container my-4">
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <h1>Cours</h1>

    <form action="cours.php" method="post" class="card card-body mb-4">
        <label for="code" class="form-label">Code :</label>
        <input type="text" name="code" id="code" class="form-control">

        <label for="nom_cours" class="form-label mt-3">Nom :</label>
        <input type="text" name="nom_cours" id="nom_cours" class="form-control">

        <input type="submit" value="Ajouter le cours" class="btn btn-primary mt-3">
    </form>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cours as $c) : ?>
                <tr>
                    <td><?= htmlspecialchars($c['code']) ?></td>
                    <td><?= htmlspecialchars($c['nom']) ?></td>
                    <td><a href="cours.php?delete=<?= $c['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
