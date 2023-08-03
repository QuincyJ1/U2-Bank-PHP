<?php

function getAccountsData() {
    $jsonData = file_get_contents('accounts.json');
    return json_decode($jsonData, true);
}


function saveAccountsData($data) {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('accounts.json', $jsonData);
}
function findAccountByKey($array, $key, $value) {
    foreach ($array as $index => $item) {
        if ($item[$key] === $value) {
            return $index;
        }
    }
    return false;
}

function isUniqueAsmensKodas($asmensKodas) {
    
    $accounts = getAccountsData();
    foreach ($accounts as $account) {
        if ($account['asmensKodas'] === $asmensKodas) {
            return false;
        }
    }
    return true;
}

function generateAccountNumber() {
   
    $letters = 'LT';
    $numbers = '0123456789';
    $length = 18;

    $accountNumber = $letters;
    for ($i = 0; $i < $length - strlen($letters); $i++) {
        $accountNumber .= $numbers[rand(0, strlen($numbers) - 1)];
    }

    return $accountNumber;
}

function findAccountByAccountNumber($accounts, $accountNumber) {
    foreach ($accounts as $key => $account) {
        if ($account['saskaitosNumeris'] === $accountNumber) {
            return $key; 
        }
    }
    return false; 
}

function isValidPersonalID($asmensKodas) {
   
    if (strlen($asmensKodas) !== 11) {
        return false;
    }
    return true;
}