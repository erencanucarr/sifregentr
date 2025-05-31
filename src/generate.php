<?php
require_once __DIR__ . '/PasswordGenerator.php';

header('Content-Type: application/json');

// Get POST data and sanitize
$length = isset($_POST['length']) ? (int)$_POST['length'] : 16;
$useUppercase = isset($_POST['useUppercase']) ? filter_var($_POST['useUppercase'], FILTER_VALIDATE_BOOLEAN) : true;
$useNumbers = isset($_POST['useNumbers']) ? filter_var($_POST['useNumbers'], FILTER_VALIDATE_BOOLEAN) : true;
$useSymbols = isset($_POST['useSymbols']) ? filter_var($_POST['useSymbols'], FILTER_VALIDATE_BOOLEAN) : true;
$useLowercase = isset($_POST['useLowercase']) ? filter_var($_POST['useLowercase'], FILTER_VALIDATE_BOOLEAN) : true;

// Ensure at least one character type is selected
if (!$useLowercase && !$useUppercase && !$useNumbers && !$useSymbols) {
    echo json_encode(['error' => 'At least one character type must be selected.']);
    exit;
}

$generator = new PasswordGenerator($length, $useUppercase, $useNumbers, $useSymbols, $useLowercase);
$password = $generator->generate();

echo json_encode(['password' => $password]); 