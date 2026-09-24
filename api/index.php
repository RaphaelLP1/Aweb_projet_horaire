<?php declare(strict_types=1);

require_once __DIR__ . '/../connexion/db.php';
require_once __DIR__ . '/../functions/creneaux.php';
require_once __DIR__ . '/../functions/cours.php';
require_once __DIR__ . '/../functions/classes.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
$endpoint = end($uri);

$endpoints = ['creneaux', 'cours', 'classes'];

if (!in_array($endpoint, $endpoints, true)) {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
    exit;
}

$readJsonBody = static function (): array {
    return json_decode(file_get_contents('php://input'), true) ?? [];
};

switch ($endpoint) {
    case 'creneaux':
        switch ($method) {
            case 'GET':
                http_response_code(200);
                echo json_encode(getAllCreneaux());
                break;

            case 'POST':
                http_response_code(201);
                $data = $readJsonBody();
                echo json_encode(createCreneaux(
                    $data['classe_id'],
                    $data['cours_id'],
                    $data['jour'],
                    $data['heure_debut'],
                    $data['heure_fin'],
                    $data['salle']
                ));
                break;

            case 'PUT':
                $data = $readJsonBody();
                echo json_encode(updateCreneaux(
                    $data['id'],
                    $data['classe_id'],
                    $data['cours_id'],
                    $data['jour'],
                    $data['heure_debut'],
                    $data['heure_fin'],
                    $data['salle']
                ));
                break;

            case 'DELETE':
                http_response_code(204);
                deleteCreneaux($_GET['id']);
                break;
        }
        break;

    case 'cours':
        switch ($method) {
            case 'GET':
                http_response_code(200);
                echo json_encode(
                    isset($_GET['classe'])
                        ? getCoursByClasse($_GET['classe'])
                        : getAllCours()
                );
                break;

            case 'POST':
                http_response_code(201);
                $data = $readJsonBody();
                echo json_encode(createCours($data['nom'], $data['code']));
                break;

            case 'PUT':
                $data = $readJsonBody();
                echo json_encode(updateCours($data['id'], $data['nom'], $data['code']));
                break;

            case 'DELETE':
                http_response_code(204);
                deleteCours($_GET['id']);
                break;
        }
        break;

    case 'classes':
        switch ($method) {
            case 'GET':
                http_response_code(200);
                echo json_encode(getAllClasses());
                break;

            case 'POST':
                http_response_code(201);
                $data = $readJsonBody();
                echo json_encode(createClasses($data['nom'], $data['annee_scolaire']));
                break;

            case 'PUT':
                $data = $readJsonBody();
                echo json_encode(updateClasses($data['id'], $data['nom'], $data['annee_scolaire']));
                break;

            case 'DELETE':
                http_response_code(204);
                deleteClasses($_GET['id']);
                break;
        }
        break;
}
