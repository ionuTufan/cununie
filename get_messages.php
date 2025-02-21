<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$messages = [];

$file_path = "uploads/mesaje/mesaje.txt";
if (file_exists($file_path)) {
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $parts = explode(": ", $line, 2);
        if (count($parts) == 2) {
            // Folosește numele din fișier, dar dacă e gol, folosește un nume implicit
            $name = !empty($parts[0]) ? $parts[0] : "Anonim";
            $messages[] = ["name" => $name, "text" => $parts[1], "file" => "mesaje.txt"];
        }
    }
}

echo json_encode($messages);
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
