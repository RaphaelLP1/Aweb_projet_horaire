<?php declare(strict_types=1);

require_once __DIR__ . '/../connexion/db.php';

function getAllCreneaux(): array
{
    return getDb()
        ->query("SELECT * FROM creneaux")
        ->fetchAll();
}

function createCreneaux(
    int|string $classesId,
    int|string $coursId,
    string $jour,
    string $heureDebut,
    string $heureFin,
    string $salle
): bool {
    $stmt = getDb()->prepare(
        "INSERT INTO creneaux(classe_id, cours_id, jour, heure_debut, heure_fin, salle)
         VALUES (:classe_id, :cours_id, :jour, :heure_debut, :heure_fin, :salle)"
    );

    return $stmt->execute([
        'classe_id' => $classesId,
        'cours_id' => $coursId,
        'jour' => $jour,
        'heure_debut' => $heureDebut,
        'heure_fin' => $heureFin,
        'salle' => $salle,
    ]);
}

function updateCreneaux(
    int|string $id,
    int|string $classesId,
    int|string $coursId,
    string $jour,
    string $heureDebut,
    string $heureFin,
    string $salle
): bool {
    $stmt = getDb()->prepare(
        "UPDATE creneaux
         SET classe_id = :classe_id, cours_id = :cours_id, jour = :jour,
             heure_debut = :heure_debut, heure_fin = :heure_fin, salle = :salle
         WHERE id = :id"
    );

    return $stmt->execute([
        'id' => $id,
        'classe_id' => $classesId,
        'cours_id' => $coursId,
        'jour' => $jour,
        'heure_debut' => $heureDebut,
        'heure_fin' => $heureFin,
        'salle' => $salle,
    ]);
}

function deleteCreneaux(int|string $id): bool
{
    $stmt = getDb()->prepare("DELETE FROM creneaux WHERE id = :id");

    return $stmt->execute(['id' => $id]);
}
