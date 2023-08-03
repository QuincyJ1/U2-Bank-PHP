<?php
require __DIR__ . '/bootstrap.php';
$title = 'Add Funds';
require __DIR__ . '/top.php';

require __DIR__ . '/menu.php'; 
require_once 'functions.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $saskaitosNumeris = $_POST['saskaita'];
    $suma = $_POST['suma'];

  
    if (is_numeric($suma) && $suma > 0) {
       
        $accounts = getAccountsData();

    
        $accountKey = findAccountByKey($accounts, 'saskaitosNumeris', $saskaitosNumeris);

        if ($accountKey !== false) {
         
            $accounts[$accountKey]['likutis'] += $suma;

           
            saveAccountsData($accounts);

            $_SESSION['message'] = 'Lėšos sėkmingai pridėtos.';
            header('Location: account_list.php');
            exit;
        } else {
            $_SESSION['message'] = 'Sąskaita nerasta.';
            header('Location: account_list.php');
            exit;
        }
    } else {
        $_SESSION['message'] = 'Klaida. Įvesta neteisinga suma.';
    }
}


if (isset($_GET['saskaita'])) {
    $saskaitosNumeris = $_GET['saskaita'];

   
    $accounts = getAccountsData();
    $accountKey = findAccountByKey($accounts, 'saskaitosNumeris', $saskaitosNumeris);

    if ($accountKey !== false) {
        
        $account = $accounts[$accountKey];
        ?>
       
        <h1>Pridėti lėšų</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<p>' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>
        <p>First Name: <?php echo $account['vardas']; ?></p>
        <p>Last Name: <?php echo $account['pavarde']; ?></p>
        <p>Account Number: <?php echo $account['saskaitosNumeris']; ?></p>
        <p>Account Balance: <?php echo $account['likutis']; ?></p>
        <form method="POST">
            <label for="suma">Amount of Money</label>
            <input type="number" name="suma" step="0.01" required><br>
            <input type="hidden" name="saskaita" value="<?php echo $saskaitosNumeris; ?>">
            <button type="submit">Add Funds</button>
        </form>
        

        <?php
        exit;
    } else {
        
        $_SESSION['message'] = 'Sąskaita nerasta.';
        header('Location: index.php');
        exit;
    }
} else {
   
    $_SESSION['message'] = 'Nepavyko gauti sąskaitos numerio.';
    header('Location: index.php');
    exit;
}
?>

<?php require __DIR__ . '/bottom.php'; ?>