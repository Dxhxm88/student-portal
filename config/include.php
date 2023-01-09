<?php

// Load the .env file
$env = parse_ini_file(asset('\.env'));

// Store the environment variables in the $_ENV superglobal array
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}

function asset($path)
{
    // Get the base URL of the application
    $baseUrl = 'D:\XAMPP\htdocs\studentportal';

    // Return the full asset URL
    return $baseUrl . '/' . ltrim($path, '/');
}

function route($path)
{
    return $_ENV['URL_PATH'] . $path;
}