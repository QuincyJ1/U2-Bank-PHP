<?php
require __DIR__ . '/bootstrap.php';
$title = 'Account List';
require __DIR__ . '/top.php';

require __DIR__ . '/menu.php'; 


require_once 'functions.php';

if (isset($_SESSION['message']) && is_string($_SESSION['message'])) {
    echo '<div class="message-container"><p>' . $_SESSION['message'] . '</p></div>';
    unset($_SESSION['message']);
}

$accounts = getAccountsData();

usort($accounts, function($a, $b) {
    return strcmp($a['pavarde'], $b['pavarde']);
});
?>

    <h1>Banko aplikacija</h1>
    <h2>Sąskaitų sąrašas</h2>
    <table>
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Sąskaitos numeris</th>
            <th>Sąskaitos likutis</th>
            <th></th>
        </tr>
        <?php foreach ($accounts as $account): ?>
        <tr>
            <td><?php echo $account['vardas']; ?></td>
            <td><?php echo $account['pavarde']; ?></td>
            <td><?php echo $account['saskaitosNumeris']; ?></td>
            <td><?php echo $account['likutis']; ?></td>
            <td>
                <a class="green" href="add_funds.php?saskaita=<?php echo $account['saskaitosNumeris']; ?>">Pridėti lėšų</a> |
                <a class="red" href="withdraw_funds.php?saskaita=<?php echo $account['saskaitosNumeris']; ?>">Nuskaičiuoti lėšas</a> |
                <a class="red" href="delete_account.php?saskaita=<?php echo $account['saskaitosNumeris']; ?>">Ištrinti</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>