<?php

/**
 * Handle requests for files in the current folder
 * 
 * The user will make a request like e.g. ?file=2024-04/Inspection%20report%20Cefn%20Glas%20Infant%20School%202024.pdf
 * in which cases we will serve the file ./2024-04/Inspection%20report%20Cefn%20Glas%20Infant%20School%202024.pdf
 * OR ./2024-04/Inspection report Cefn Glas Infant School 2024.pdf
 * because some files' names actually have "%20" in them!
 */

// Get the requested file
$file = $_GET['file'] ?? null;

// If no file was requested, return a 404
if (!$file) {
    http_response_code(404);
    die('No file requested');
}

// Get the path to the file
$path = __DIR__ . '/' . $file;

// If the file doesn't exist, return a 404
if (!file_exists($path)) {
    // Try it with '%20' in place of spaces
    $file = str_replace(' ', '%20', $file);
    $path = __DIR__ . '/' . $file;

    if (!file_exists($path)) {
        http_response_code(404);
        die('File not found');
    }
} 

// Get the file's mime type
$mime = mime_content_type($path);

// Set the headers
header('Content-Type: ' . $mime);
header('Content-Disposition: inline; filename="' . basename($path) . '"');

// Output the file
readfile($path);

// Exit
exit;

