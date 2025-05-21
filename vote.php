<?php
// vote.php

// Fichier pour stocker les votes
$file = 'votes.json';

// Lire les votes existants
if (file_exists($file)) {
    $votes = json_decode(file_get_contents($file), true);
} else {
    $votes = ['option1' => 0, 'option2' => 0, 'option3' => 0, 'option4' => 0];
}

// Traiter une requête POST pour enregistrer un vote
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'] ?? '';
    if (array_key_exists($option, $votes)) {
        $votes[$option]++;
        file_put_contents($file, json_encode($votes));
        echo json_encode(['status' => 'success', 'votes' => $votes]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid option']);
    }
    exit;
}

// Traiter une requête GET pour récupérer les votes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($votes);
    exit;
}
?>
