<?php
require __DIR__ . '/bootstrap.php';
$title = 'Bank Accounts';
require __DIR__ . '/top.php';

require __DIR__ . '/menu.php'; 

require_once 'functions.php';

$saskaitosNumeris = $_GET['saskaita'];


$accounts = getAccountsData();


$accountKey = findAccountByKey($accounts, 'saskaitosNumeris', $saskaitosNumeris);

if ($accountKey !== false) {
  
    if ($accounts[$accountKey]['likutis'] == 0) {
        
        unset($accounts[$accountKey]);

       
        $accounts = array_values($accounts);

        
        saveAccountsData($accounts);

        $_SESSION['message'] = 'Sąskaita ištrinta.';
        header('Location: account_list.php');
        exit;
    } else {
        $_SESSION['message'] = 'Sąskaita turi pinigų. Jos ištrinti negalima.';
        header('Location: account_list.php');
        exit;
    }
} else {
    $_SESSION['message'] = 'Sąskaita nerasta.';
    header('Location: account_list.php');
    exit;
}
?>