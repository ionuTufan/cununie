<?php
// Setează erorile pentru a fi afișate la dezvoltare (ajută la debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Răspunsul default
$response = ["success" => false, "message" => ""];  // Default message

// Verifică dacă cererea este de tip POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică dacă există câmpul "message" și "name" în request
    if (isset($_POST['message'])) {
        $message = strip_tags(trim($_POST['message']));  // Curăță mesajul pentru a preveni injectările HTML
        $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : "Anonim";  // Dacă nu există un nume, folosește "Anonim"

        if (!empty($message)) {
            // Directorul unde vor fi salvate mesajele
            $message_dir = "uploads/mesaje/";

            // Crează folderul dacă nu există
            if (!is_dir($message_dir)) {
                mkdir($message_dir, 0777, true);  // Permite permisiuni de scriere
            }

            // Calea completă a fișierului în care vor fi salvate mesajele
            $file_path = $message_dir . "mesaje.txt";

            // Deschide fișierul pentru a adăuga mesajul
            $file = fopen($file_path, "a");
            if ($file) {
                fwrite($file, $name . ": " . $message . "\n\n");  // Adaugă mesajul în fișier
                fclose($file);

                // Răspuns de succes
                $response["success"] = true;
                $response["message"] = "Mesajul a fost salvat cu succes!";
            } else {
                // Răspuns de eroare în cazul în care nu s-a putut salva fișierul
                $response["message"] = "Nu s-a putut salva mesajul!";
            }
        } else {
            // Dacă mesajul este gol
            $response["message"] = "Mesajul nu poate fi gol!";
        }
    } else {
        // Dacă nu există câmpul 'message' în cererea POST
        $response["message"] = "Mesajul nu a fost trimis corect!";
    }
} else {
    // Dacă cererea nu este de tip POST
    $response["message"] = "Cerere invalidă!";
}

// Setează antetul pentru JSON
header('Content-Type: application/json');

// Trimite răspunsul JSON
echo json_encode($response);
