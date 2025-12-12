<?php
header("Content-Type: text/plain");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Get POSTed JSON data
$data = json_decode(file_get_contents("php://input"), true);

$account_no = $data["account_no"] ?? '';
$getTownCode = substr($account_no, 0, 2);
$consumer_name = $data["consumer_name"] ?? '';
$address = $data["address"] ?? '';
$or_number = $data["or_number"] ?? null;   // allow null
$townCode =  $getTownCode ?? null; // allow null

if (empty($account_no) || empty($consumer_name)) {
    echo "Missing account number or consumer name"; // specific error
    exit;
}

$serverName = "127.0.0.1";
$database = "usi_customerdb";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check duplicate
    $checkStmt = $conn->prepare("SELECT COUNT(*) as count FROM scannedqrdata WHERE account_no = :account_no");
    $checkStmt->execute([":account_no" => $account_no]);
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "Duplicate account number"; // specific error
        exit;
    }

    // Insert record
    $stmt = $conn->prepare("
        INSERT INTO scannedqrdata 
        (account_no, consumer_name, address, or_number, townCode, created_at, updated_at)
        VALUES 
        (:account_no, :consumer_name, :address, :or_number, :townCode, NOW(), NOW())
    ");

    $stmt->execute([
        ":account_no" => $account_no,
        ":consumer_name" => $consumer_name,
        ":address" => $address,
        ":or_number" => $or_number,
        ":townCode" => $townCode
    ]);

    echo "success";

} catch (PDOException $e) {
    // Return the PDO error message for debugging
    echo "Database error: " . $e->getMessage();
}
