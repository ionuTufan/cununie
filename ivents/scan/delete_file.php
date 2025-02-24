<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$response = ["success" => false, "message" => "Eroare la procesare."];

// Verifică dacă cererea este POST și că avem tipul și numele fișierului
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["type"]) && isset($_POST["filename"])) {
    $type = $_POST["type"];
    $filename = basename($_POST["filename"]); // evită posibilele atacuri cu căi relativiste

    // Setează calea corectă pe baza tipului de fișier
    $folder = "";
    if ($type === "poze") {
        $folder = "uploads/poze/";
    } elseif ($type === "video") {
        $folder = "uploads/video/";
    } elseif ($type === "mesaje") {
        $folder = "uploads/mesaje/";
    }

    // Dacă folderul este setat și fișierul există
    if ($folder && file_exists($folder . $filename)) {
        if (unlink($folder . $filename)) {
            $response["success"] = true;
            $response["message"] = "Fișier șters cu succes!";
        } else {
            $response["message"] = "Eroare la ștergerea fișierului.";
        }
    } else {
        $response["message"] = "Fișierul nu există.";
    }
} else {
    $response["message"] = "Date lipsă.";
}

echo json_encode($response);
?>
