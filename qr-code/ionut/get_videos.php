<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$directory = 'uploads/video/';
$files = array_diff(scandir($directory), ['.', '..']);

$videos = array_values(array_filter($files, function ($file) use ($directory) {
    return preg_match('/\.(mp4|avi|mov|wmv)$/i', $file);
}));

echo json_encode($videos);
?>
