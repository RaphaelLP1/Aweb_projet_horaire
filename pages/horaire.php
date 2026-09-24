<?php
require_once __DIR__ . '/../functions/creneaux.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/classes.php';

$isHome = false;
$active = 'horaire';
include_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createCreneaux(
        $_POST['classe_id'],
        $_POST['cours_id'],
        $_POST['jour'],
        $_POST['heure_debut'],
        $_POST['heure_fin'],
        $_POST['salle']
    );
}

if (isset($_GET['delete'])) {
    deleteCreneaux($_GET['delete']);
}

$classes = getAllClasses();
$cours = getAllCours();
$creneaux = getAllCreneaux();

// Tables de correspondance id -> nom, construites en une seule passe chacune.
$classesParId = array_column($classes, 'nom', 'id');
$coursParId = array_column($cours, 'nom', 'id');
?>

<main class="container my-4">
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <h1>Horaire</h1>

    <form action="horaire.php" method="post" class="card card-body mb-4">
        <label for="classe_id" class="form-label">Classe :</label>
        <select name="classe_id" id="classe_id" class="form-select">
            <?php foreach ($classes as $classe) : ?>
                <option value="<?= $classe['id'] ?>"><?= htmlspecialchars($classe['nom']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="cours_id" class="form-label mt-3">Cours :</label>
        <select name="cours_id" id="cours_id" class="form-select">
            <?php foreach ($cours as $c) : ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['code'] . ' - ' . $c['nom']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="jour" class="form-label mt-3">Jour :</label>
        <select name="jour" id="jour" class="form-select">
            <option value="lundi">lundi</option>
            <option value="mardi">mardi</option>
            <option value="mercredi">mercredi</option>
            <option value="jeudi">jeudi</option>
            <option value="vendredi">vendredi</option>
        </select>

        <label for="heure_debut" class="form-label mt-3">Heure de début :</label>
        <input type="time" name="heure_debut" id="heure_debut" class="form-control">

        <label for="heure_fin" class="form-label mt-3">Heure de fin :</label>
        <input type="time" name="heure_fin" id="heure_fin" class="form-control">

        <label for="salle" class="form-label mt-3">Salle :</label>
        <input type="text" name="salle" id="salle" class="form-control">

        <input type="submit" value="Ajouter l'horaire" class="btn btn-primary mt-3">
    </form>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Classe</th>
                <th scope="col">Cours</th>
                <th scope="col">Jour</th>
                <th scope="col">Début</th>
                <th scope="col">Fin</th>
                <th scope="col">Salle</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($creneaux as $creneau) : ?>
                <tr>
                    <td><?= htmlspecialchars($classesParId[$creneau['classe_id']]) ?></td>
                    <td><?= htmlspecialchars($coursParId[$creneau['cours_id']]) ?></td>
                    <td><?= htmlspecialchars($creneau['jour']) ?></td>
                    <td><?= substr($creneau['heure_debut'], 0, 5) ?></td>
                    <td><?= substr($creneau['heure_fin'], 0, 5) ?></td>
                    <td><?= htmlspecialchars($creneau['salle']) ?></td>
                    <td><a href="horaire.php?delete=<?= $creneau['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
