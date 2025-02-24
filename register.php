<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["folder_name"]);
    $uniqueID = uniqid(); // Generare ID unic
    $folderName = $name . "_" . $uniqueID; // Ex: mihai&mihaela_67bc4599acc63
    $source = "scan"; 
    $destination = "qr-code/" . $folderName;

    // Verificăm că numele folderului este valid
    if (!empty($name) && preg_match("/^[a-zAZ0-9 &_]+$/", $name)) {  
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);

            // Copierea folderului
            function copyFolder($src, $dst) {
                if (!is_dir($src)) return;

                $files = scandir($src);
                foreach ($files as $file) {
                    if ($file === "." || $file === "..") continue;

                    $srcFile = "$src/$file";
                    $dstFile = "$dst/$file";

                    if (is_dir($srcFile)) {
                        mkdir($dstFile, 0777, true);
                        copyFolder($srcFile, $dstFile);
                    } else {
                        copy($srcFile, $dstFile);
                    }
                }
            }

            // Copiem fișierele din folderul sursă
            copyFolder($source, $destination);

            // Gestionează încărcarea imaginii
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadedImage = $_FILES['image'];
                $uploadDir = $destination . '/';
                $imageName = '6.png'; // Numele fișierului imaginii dorite

                // Verificăm dacă fișierul este o imagine validă
                $imageType = mime_content_type($uploadedImage['tmp_name']);
                if (in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    // Mutăm fișierul încărcat în folderul nou
                    move_uploaded_file($uploadedImage['tmp_name'], $uploadDir . $imageName);
                } else {
                    echo "<p>Fișierul încărcat nu este o imagine validă!</p>";
                    exit;
                }
            }

            // Generăm linkurile
            $url1 = "https://ivents.ro/qr-code/" . $folderName;
            $url2 = $url1 . "/admin";

            // Afișăm popup cu linkurile generate
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let popup = document.createElement('div');
                        popup.style.position = 'fixed';
                        popup.style.top = '50%';
                        popup.style.left = '50%';
                        popup.style.transform = 'translate(-50%, -50%)';
                        popup.style.backgroundColor = 'white';
                        popup.style.padding = '20px';
                        popup.style.border = '1px solid black';
                        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                        popup.style.zIndex = '1000';
                        popup.innerHTML = '<h3>Linkuri generate:</h3>' +
                                          '<p><a href=\"" . $url1 . "\" target=\"_blank\">" . $url1 . "</a></p>' +
                                          '<p><a href=\"" . $url2 . "\" target=\"_blank\">" . $url2 . "</a></p>' +
                                          '<button onclick=\"window.location.href = window.location.href;\">OK</button>';
                        document.body.appendChild(popup);
                    });
                  </script>";
        } else {
            echo "<p>Folderul '$folderName' există deja!</p>";
        }
    } else {
        echo "<p>Nume invalid! Folosește doar litere, cifre, spații, '-', '_', sau '&'.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
</head>
<body>
    <h2>Introdu un nume pentru noul folder și încarcă o imagine:</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="folder_name" id="folder_name" required placeholder="tastează...">
        <br><br>
        <input type="file" name="image" accept="image/*">
        <br><br>
        <button type="submit">Continuă</button>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let folderInput = document.getElementById("folder_name");

        // Verificăm dacă input-ul este gol înainte de a-i atribui o valoare automată
        document.querySelector("form").addEventListener("submit", function(e) {
            if (!folderInput.value) {
                let uniqueID = Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
                folderInput.value = "Folder_" + uniqueID; // Setăm ID-ul unic înainte de trimiterea formularului
            }
        });
    });
    </script>
</body>
</html>
