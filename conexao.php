<?php
require_once __DIR__.'/vendor/autoload.php';

$envPath = __DIR__.'/.env';

session_name('__Secure-RASPASESSID');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

if (file_exists($envPath)) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$inMaintenance = $_ENV['MAINTENANCE'] === 'true';
$allowedIps = explode(',', $_ENV['MAINTENANCE_ALLOWED_IPS']);
$foundIps = array_search($_SERVER['REMOTE_ADDR'], $allowedIps);

if ($inMaintenance && !$foundIps) {
    require_once __DIR__ . '/maintenance.php';
    http_response_code(200);
    exit();
}


$host = $_ENV['DATABASE_HOST'];
$db   = $_ENV['DATABASE_NAME'];
$user = $_ENV['DATABASE_USER'];
$pass = $_ENV['DATABASE_PASSWORD'];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$site = $pdo->query("SELECT nome_site, logo, deposito_min, saque_min, cpa_padrao, revshare_padrao FROM config LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$nomeSite = $site['nome_site'] ?? '';
$logoSite = $site['logo'] ?? '';
$depositoMin = $site['deposito_min'] ?? 10;
$saqueMin = $site['saque_min'] ?? 50;
$cpaPadrao = $site['cpa_padrao'] ?? 10;
$revshare_padrao = $site['revshare_padrao'] ?? 10;
