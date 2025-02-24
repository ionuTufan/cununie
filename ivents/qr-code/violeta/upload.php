<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);  // Oprește afișarea erorilor în browser
ini_set('log_errors', 1); // Activează logarea erorilor
ini_set('error_log', '/path/to/your/php-error.log');  // Înlocuiește cu calea către fișierul tău de log

header("Content-Type: application/json"); // Setează header-ul pentru JSON

$response = ["success" => false, "message" => ""]; // Inițializare corectă a răspunsului

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["files"])) {
    $image_dir = "uploads/poze/";
    $video_dir = "uploads/video/";

    // Crează folderele pentru poze și video dacă nu există
    if (!is_dir($image_dir)) {
        mkdir($image_dir, 0777, true);
    }
    if (!is_dir($video_dir)) {
        mkdir($video_dir, 0777, true);
    }

    // Verificăm numărul de fișiere încărcate
    $file_count = count($_FILES["files"]["name"]);
    $uploaded_files = [];

    for ($i = 0; $i < $file_count; $i++) {
        // Verifică dacă fișierul a fost încărcat cu succes
        if ($_FILES["files"]["error"][$i] !== UPLOAD_ERR_OK) {
            $response["message"] = "Eroare la încărcare: " . $_FILES["files"]["error"][$i];
            echo json_encode($response);
            exit();
        }

        $file_name = basename($_FILES["files"]["name"][$i]);
        $file_tmp_name = $_FILES["files"]["tmp_name"][$i];
        $file_type = $_FILES["files"]["type"][$i];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Obține extensia fișierului
        $target_file = '';

        // Convertim HEIC în JPG dacă este cazul
        if ($file_ext === "heic") {
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . ".jpg";
            $file_ext = "jpg";
            $file_name = $new_file_name;
        }

        // Determinăm unde să salvăm fișierul
    // Determinăm unde să salvăm fișierul
if (in_array($file_ext, ["jpg", "jpeg", "png", "gif", "bmp", "heic", "webp"])) {
    $target_file = $image_dir . time() . '_' . $file_name;
} elseif (in_array($file_ext, ["mp4", "avi", "mov", "mkv", "flv", "HEVC", "H.264"])) {
    $target_file = $video_dir . time() . '_' . $file_name;
} else {
    // Dacă fișierul nu este imagine sau video, îl salvăm într-un folder necunoscut
    $target_file = "uploads/unknown/" . time() . '_' . $file_name;
}


        // Mutăm fișierul în locația corespunzătoare
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            // Adăugăm fișierul la lista de fișiere încărcate
            $uploaded_files[] = $target_file;
        } else {
            $response["message"] = "Eroare la mutarea fișierului: " . $_FILES["files"]["error"][$i];
            echo json_encode($response);
            exit();
        }
    }

    // Dacă fișierele au fost încărcate cu succes
    if (!empty($uploaded_files)) {
        $response["success"] = true;
        $response["message"] = "Fișiere încărcate cu succes!";
        $response["files"] = $uploaded_files;
    } else {
        $response["message"] = "Nicio imagine/video nu a fost încărcată.";
    }
} else {
    $response["message"] = "Nu a fost trimis niciun fișier.";
}

echo json_encode($response); // Returnează răspunsul final în format JSON
?>
