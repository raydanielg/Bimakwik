<?php
$dbPath = 'c:/Users/nafid/Bimakwik/database/database.sqlite';

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check users count
    $result = $pdo->query('SELECT COUNT(*) as count FROM users')->fetch();
    echo "✓ Database connected successfully\n";
    echo "✓ Total users in database: " . $result['count'] . "\n\n";
    
    // List all users
    $users = $pdo->query('SELECT id, name, email FROM users')->fetchAll();
    echo "Users in database:\n";
    foreach ($users as $user) {
        echo "  - " . $user['email'] . " (" . $user['name'] . ")\n";
    }
    
    // Test password for broker
    $broker = $pdo->query("SELECT password FROM users WHERE email = 'broker@bimakwik.com'")->fetch();
    if ($broker) {
        $isValid = password_verify('password', $broker['password']) ? 'YES' : 'NO';
        echo "\n✓ Broker account password valid: " . $isValid . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
}
?>
