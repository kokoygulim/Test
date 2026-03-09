<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Get the raw POST data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data === null) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
    exit;
}

// Validate required fields
if (!isset($data['app_title']) || !isset($data['devices'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// ✅ সেটিংস সিস্টেমের default values অ্যাড করুন
if (!isset($data['description'])) {
    $data['description'] = 'Secure your application with premium protection';
}
if (!isset($data['dialog_enabled'])) {
    $data['dialog_enabled'] = true;
}
if (!isset($data['contact_button_enabled'])) {
    $data['contact_button_enabled'] = true;
}
if (!isset($data['device_id_enabled'])) {
    $data['device_id_enabled'] = true;
}
if (!isset($data['expiry_date_enabled'])) {
    $data['expiry_date_enabled'] = true;
}
if (!isset($data['contact_url'])) {
    $data['contact_url'] = 'https://example.com/contact';
}
if (!isset($data['renew_url'])) {
    $data['renew_url'] = 'https://example.com/renew';
}

// File path to save JSON
$json_file_path = 'test.json';

// Save the JSON data to file
if (file_put_contents($json_file_path, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['status' => 'success', 'message' => 'JSON updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save JSON file']);
}
?> 
