<?php

require_once __DIR__ . '/../src/PasswordGenerator.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $length = $data['length'] ?? 16;
    $useUppercase = $data['uppercase'] ?? true;
    $useNumbers = $data['numbers'] ?? true;
    $useSymbols = $data['symbols'] ?? true;

    $generator = new PasswordGenerator(
        $length,
        $useUppercase,
        $useNumbers,
        $useSymbols
    );

    $password = $generator->generate();
    $strength = $generator->getStrength($password);

    echo json_encode([
        'password' => $password,
        'strength' => $strength['strength'],
        'feedback' => $strength['feedback']
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
