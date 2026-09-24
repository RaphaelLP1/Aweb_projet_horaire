<?php declare(strict_types=1);

require_once __DIR__ . '/../connexion/db.php';

function getAllCours(): array
{
    return getDb()
        ->query("SELECT * FROM cours")
        ->fetchAll();
}

function createCours(string $nom, string $code): bool
{
    $stmt = getDb()->prepare(
        "INSERT INTO cours(nom, code) VALUES (:nom, :code)"
    );

    return $stmt->execute([
        'nom' => $nom,
        'code' => $code,
    ]);
}

function updateCours(int|string $id, string $nom, string $code): bool
{
    $stmt = getDb()->prepare(
        "UPDATE cours SET nom = :nom, code = :code WHERE id = :id"
    );

    return $stmt->execute([
        'id' => $id,
        'nom' => $nom,
        'code' => $code,
    ]);
}

function deleteCours(int|string $id): bool
{
    $stmt = getDb()->prepare("DELETE FROM cours WHERE id = :id");

    return $stmt->execute(['id' => $id]);
}

function getCoursByClasse(string $classeNom): array
{
    $stmt = getDb()->prepare(
        "SELECT cl.nom AS classe, cl.annee_scolaire, c.nom AS cours, c.code AS code_cours,
                cr.jour, cr.heure_debut, cr.heure_fin, cr.salle
         FROM creneaux cr
         JOIN cours c ON c.id = cr.cours_id
         JOIN classes cl ON cl.id = cr.classe_id
         WHERE cl.nom = :classe"
    );
    $stmt->execute(['classe' => $classeNom]);
    $creneaux = $stmt->fetchAll();

    if (count($creneaux) === 0) {
        return [
            'classe' => $classeNom,
            'annee_scolaire' => null,
            'horaires' => [],
        ];
    }

    $horaires = array_map(static function (array $creneau): array {
        return [
            'jour' => $creneau['jour'],
            'heure_debut' => substr($creneau['heure_debut'], 0, 5),
            'heure_fin' => substr($creneau['heure_fin'], 0, 5),
            'cours' => $creneau['cours'],
            'code_cours' => $creneau['code_cours'],
            'salle' => $creneau['salle'],
        ];
    }, $creneaux);

    return [
        'classe' => $creneaux[0]['classe'],
        'annee_scolaire' => $creneaux[0]['annee_scolaire'],
        'horaires' => $horaires,
    ];
}
