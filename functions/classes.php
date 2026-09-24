<?php declare(strict_types=1);

require_once __DIR__ . '/../connexion/db.php';

function getAllClasses(): array
{
    return getDb()
        ->query("SELECT * FROM classes")
        ->fetchAll();
}

function createClasses(string $nom, string $anneeScolaire): bool
{
    $stmt = getDb()->prepare(
        "INSERT INTO classes(nom, annee_scolaire) VALUES (:nom, :annee_scolaire)"
    );

    return $stmt->execute([
        'nom' => $nom,
        'annee_scolaire' => $anneeScolaire,
    ]);
}

function updateClasses(int|string $id, string $nom, string $anneeScolaire): bool
{
    $stmt = getDb()->prepare(
        "UPDATE classes SET nom = :nom, annee_scolaire = :annee_scolaire WHERE id = :id"
    );

    return $stmt->execute([
        'id' => $id,
        'nom' => $nom,
        'annee_scolaire' => $anneeScolaire,
    ]);
}

function deleteClasses(int|string $id): bool
{
    $stmt = getDb()->prepare("DELETE FROM classes WHERE id = :id");

    return $stmt->execute(['id' => $id]);
}
