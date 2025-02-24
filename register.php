<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["folder_name"]);
    $source = "scan"; // Folderul original
    $destination = "qr-code/" . $name; // Noul folder în "qr-code/"

    if (!empty($name) && preg_match("/^[a-zA-Z0-9_-]+$/", $name)) {
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
            
            // Funcție pentru copiere recursivă a fișierelor și folderelor
            function copyFolder($src, $dst) {
                if (!is_dir($src)) return; // Asigură-te că sursa este un folder
                
                $files = scandir($src);
                foreach ($files as $file) {
                    if ($file === "." || $file === "..") continue;

                    $srcFile = "$src/$file";
                    $dstFile = "$dst/$file";

                    if (is_dir($srcFile)) {
                        mkdir($dstFile, 0777, true);
                        copyFolder($srcFile, $dstFile); // Copiere recursivă
                    } else {
                        copy($srcFile, $dstFile);
                    }
                }
            }
            
            copyFolder($source, $destination);
            echo "<p>Folder '$name' creat cu succes în '$destination'!</p>";
        } else {
            echo "<p>Folderul '$name' există deja!</p>";
        }
    } else {
        echo "<p>Nume invalid! Folosește doar litere, cifre, '-' sau '_'.</p>";
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
    <h2>Introdu un nume pentru noul folder:</h2>
    <form method="POST">
        <input type="text" name="folder_name" required>
        <button type="submit">Continuă</button>
    </form>
</body>
</html>
