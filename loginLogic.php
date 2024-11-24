<?php
include "ConClass.php";

session_start();
$mysql = Database::connection();

$login = '';
if (isset($_POST['logmail']))
{
    $login = htmlspecialchars($_POST['logmail']);
}
if (isset($_POST['logpass']))
{
    $password = htmlspecialchars($_POST['logpass']);
}

$Salt = "1afa148eb41f2e7103f21410bf48346c";
$pass_hash ="";
$arrerr= [
    'login' =>"",
    'pass' =>"",
    'nouser'=>"",
];

$errs = 0;
if (isset($_POST['login'])) {


    if ($login == "") {
        $arrerr['login'] = 'Введите логин';
        $errs++;
    }
    if ($password == "") {
        $arrerr['pass'] = 'Введите пароль';
        $errs++;
    }

    if ($errs == 0) {
        $PasswordHash = md5($Salt . $password);
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $mysql->prepare($query);
        $stmt->bind_param('ss', $login, $PasswordHash);
        $stmt->execute();
        $result = $stmt->get_result();
        $res = $result->fetch_assoc();
        if (!$res)
        {
            $arrerr['nouser'] = "Пользователей с такими данными нет.";
            $errs++;
        } else
        {
            $_SESSION['mail'] = $login;
            $accountType = $res['account_type'];
            if ($accountType == 0)
            {
            	header(header: 'Location: doTest_frame.php');
        	} else header(header: 'Location: manager_frame.php');
        }
    }
}



if (key_exists('exit',$_POST))
{
    $_SESSION["mail"]="";
}
?>