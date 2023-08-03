<?php
require __DIR__ . '/bootstrap.php';
$title = 'Create Account';
require __DIR__ . '/top.php';

require __DIR__ . '/menu.php'; 

require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vardas = $_POST['vardas'];
    $pavarde = $_POST['pavarde'];
    $asmensKodas = $_POST['asmensKodas'];

   
    if (strlen($vardas) > 3 && strlen($pavarde) > 3) {
       
        if (isUniqueAsmensKodas($asmensKodas)) {
           
            $saskaitosNumeris = generateAccountNumber();

            if (!isValidPersonalID($asmensKodas)) {
                $_SESSION['message'] = 'Neteisingas asmens kodas. Asmens kodą turi sudaryti 11 skaitmenų.';
                header('Location: create_account.php');
                exit;
            }

            
            $accountData = [
                'vardas' => $vardas,
                'pavarde' => $pavarde,
                'saskaitosNumeris' => $saskaitosNumeris,
                'asmensKodas' => $asmensKodas,
                'likutis' => 0
            ];

           
            $accounts = getAccountsData();

           
            $accounts[] = $accountData;

          
            saveAccountsData($accounts);

            $_SESSION['message'] = 'Sėkmingai sukurta nauja sąskaita';
            header('Location: account_list.php');
            exit;
        } else {
            $_SESSION['message'] = 'Toks asmens kodas jau egzistuoja';
        }
    } else {
        $_SESSION['message'] = 'Klaida. Vardą ir pavardę turi sudaryti daugiau negu 3 simboliai';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Naujos sąskaitos sukūrimas</title>
</head>
<body>
    <h1>Naujos sąskaitos sukūrimas</h1>
   <?php
if (isset($_SESSION['message'])) {
    echo '<div class="message-container"><p>' . $_SESSION['message'] . '</p></div>';
    unset($_SESSION['message']);
}
?>
    <form method="POST">
        <label for="vardas">Vardas:</label>
        <input type="text" name="vardas" required><br>
        <label for="pavarde">Pavardė:</label>
        <input type="text" name="pavarde" required><br>
        <label for="asmensKodas">Asmens kodas:</label>
        <input type="text" name="asmensKodas" maxlength="11" required><br>
        <label for="saskaitosNumeris">Sąskaitos numeris:</label>
        <input type="text" name="accountNumber" value="<?php echo generateAccountNumber(); ?>" readonly><br>
        <button type="submit">Sukurti sąskaitą</button>
    </form>
    
</body>
</html>