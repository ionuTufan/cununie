<?php
$folder = '../uploads/poze/';
$archiveFile = 'galerie.tar.gz';

if (file_exists($archiveFile)) {
    unlink($archiveFile);
}

$cmd = "tar -czf $archiveFile -C $folder .";
exec($cmd, $output, $result);

if ($result === 0 && file_exists($archiveFile)) {
    header('Content-Type: application/gzip');
    header('Content-Disposition: attachment; filename="galerie.tar.gz"');
    header('Content-Length: ' . filesize($archiveFile));
    readfile($archiveFile);
    unlink($archiveFile); // Șterge fișierul după descărcare
} else {
    die(json_encode(["success" => false, "message" => "Eroare la crearea arhivei."]));
}
?>
