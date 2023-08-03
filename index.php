<?php
require __DIR__ . '/bootstrap.php';
$title = 'Bank';
require __DIR__ . '/top.php';

require __DIR__ . '/menu.php'; 


require_once 'functions.php';

if (isset($_SESSION['message']) && is_string($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);
}

$accounts = getAccountsData();

usort($accounts, function($a, $b) {
    return strcmp($a['pavarde'], $b['pavarde']);
});
?>

<div class="home">
    <h1>Make banking great again</h1>
</div>
</body>
</html>