<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/load.php';
use Damero\User;
use Damero\Exempcions\WeekPasswordException;
use Damero\Exempcions\RequiredFieldException;
use Damero\Exempcions\InvalidEmailException;
use Damero\Exempcions\PasswordDoNotMatchException;


// Comprovar si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar camp nick
        $nick = $_POST['nick'] ?? '';
        if (empty($nick)) {
            throw new RequiredFieldException("El camp Nick és obligatori.");
        }

        // Validar camp email
        $email = $_POST['email'] ?? '';
        if (empty($email)) {
            throw new RequiredFieldException("El camp Email és obligatori.");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("L'email proporcionat no és vàlid.");
        }

        // Validar contrasenyes
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        if (empty($password) || empty($confirm_password)) {
            throw new RequiredFieldException("La contrasenya és obligatòria.");
        } elseif ($password !== $confirm_password) {
            throw new PasswordDoNotMatchException("Les contrasenyes no coincideixen.");
        }


        $user = new User($email, $password, $nick);
        $_SESSION['userId'] = $user->save();

        header("Location: index.php");
        exit;

    } catch (RequiredFieldException | InvalidEmailException | PasswordDoNotMatchException | WeekPasswordException $e) {
        // Capturar les excepcions i mostrar missatges d'error
        echo $e->getMessage();
        exit;
    }
} else {
    // Si el formulari no s'ha enviat, mostrar-lo
    include_once('views/user/register.view.php'); // Ajusta el camí al teu fitxer de formulari
}

