<?php
// Veritabanı bağlantı bilgileri
$host = "localhost";
$user = "leyn_user";
$password = "ysp3nbXDbO";
$dbname = "leyn_leyn";

// PostgreSQL'e bağlanmaÏ
try {
    $conn = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "PostgreSQL'e başarıyla bağlandı.\n";
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage() . "\n";
}

// Veri çekme sorgusu
$sql = "SELECT name FROM excels";
$result = $conn->query($sql);

// Veriyi ekrana yazdırma
if ($result->rowCount() > 0) {
    foreach ($result as $row) {
        echo "ID: " . $row["name"];
    }
} else {
    echo "0 sonuç";
}

// Bağlantıyı kapat
$conn = null;
?>