<?php
$isHome = true;
$active = 'accueil';
include_once __DIR__ . '/includes/header.php';
?>

<main class="container my-4">
    <?php include __DIR__ . '/includes/nav.php'; ?>

    <h1>Accueil</h1>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h5">Cours</h2>
                    <p class="card-text">Ajouter et supprimer des cours.</p>
                    <a href="pages/cours.php" class="btn btn-primary">Gérer les cours</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h5">Classes</h2>
                    <p class="card-text">Ajouter et supprimer des classes.</p>
                    <a href="pages/classes.php" class="btn btn-primary">Gérer les classes</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h5">Horaire</h2>
                    <p class="card-text">Saisir et consulter les horaires.</p>
                    <a href="pages/horaire.php" class="btn btn-primary">Gérer les horaires</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
