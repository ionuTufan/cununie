<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$directory = 'uploads/poze/'; // Directorul corect

if (!is_dir($directory)) {
    die(json_encode(["error" => "Folderul nu există: " . $directory]));
}

$files = array_diff(scandir($directory), array('.', '..'));

$images = array_values(array_filter($files, function($file) use ($directory) {
   return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
}));

if (empty($images)) {
    die(json_encode(["error" => "Nu există imagini în: " . $directory]));
}

header('Content-Type: application/json');
echo json_encode($images);
?>
