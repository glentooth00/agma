<?php
header("Content-Type: text/plain"); // Use plain text for Flutter popup
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Get POSTed JSON data
$data = json_decode(file_get_contents("php://input"), true);

$account_no = $data["account_no"] ?? '';
$consumer_name = $data["consumer_name"] ?? '';
$address = $data["address"] ?? '';
$or_number = $data["or_number"] ?? '';
$townCode = $data["townCode"]
         ?? $data["towncode"]
         ?? $data["town_code"]
         ?? '';


if (empty($account_no) || empty($consumer_name)) {
    echo "Missing account number or consumer name";
    exit;
}

// SQL Server connection
$serverName = "192.168.4.67";
$database = "ILECO3";
$username = ""; // fill if needed
$password = "";

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if account_no already exists
    $checkStmt = $conn->prepare("SELECT COUNT(*) as count FROM ScannedQRData WHERE account_no = :account_no");
    $checkStmt->execute([":account_no" => $account_no]);
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Duplicate found
        echo "duplicate"; // <-- Plain text "duplicate" so Flutter can detect it
        exit;
    }

    // Insert new record
    $stmt = $conn->prepare("
        INSERT INTO ScannedQRData (account_no, consumer_name, address, or_number, townCode, created_at, updated_at)
        VALUES (:account_no, :consumer_name, :address, :or_number, :townCode, GETDATE(), GETDATE())
    ");

    $stmt->execute([
        ":account_no" => $account_no,
        ":consumer_name" => $consumer_name,
        ":address" => $address,
        ":or_number" => $or_number,
        ":townCode" => $townCode
    ]);

    echo "success"; // <-- Plain text "success" for Flutter

} catch (PDOException $e) {
    echo "error"; // <-- Plain text "error" for Flutter
}
