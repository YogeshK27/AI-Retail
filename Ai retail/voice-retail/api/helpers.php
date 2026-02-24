<?php
function json_response($data, $status = 200) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
    exit;
}
function require_api_key() {
    $config = require __DIR__ . '/../config.php';
    $headers = getallheaders();
    $provided = $headers['X-API-KEY'] ?? $_GET['api_key'] ?? null;
    if (!$provided || $provided !== $config['api_key']) {
        json_response(['error' => 'Unauthorized (invalid API key)'], 401);
    }
}
