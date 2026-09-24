<?php
/**
 * Attend une variable $active ('accueil' | 'cours' | 'classes' | 'horaire')
 * définie par la page avant l'include, pour savoir quel lien surligner.
 */
$active ??= '';

$links = [
    'accueil' => ['href' => $isHome ? 'index.php' : '../index.php', 'label' => 'Accueil'],
    'cours' => ['href' => $isHome ? 'pages/cours.php' : 'cours.php', 'label' => 'Cours'],
    'classes' => ['href' => $isHome ? 'pages/classes.php' : 'classes.php', 'label' => 'Classes'],
    'horaire' => ['href' => $isHome ? 'pages/horaire.php' : 'horaire.php', 'label' => 'Horaire'],
];
?>
<nav>
    <ul class="nav nav-pills justify-content-center my-4">
        <?php foreach ($links as $key => $link) : ?>
            <li class="nav-item">
                <a class="nav-link<?= $key === $active ? ' active' : '' ?>" href="<?= $link['href'] ?>">
                    <?= $link['label'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
