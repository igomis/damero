<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/load.php';

use Damero\Exempcions\RequiredFieldException;
use Damero\Exempcions\InvalidEmailException;
use Damero\Exempcions\PasswordDoNotMatchException;
use Damero\User;


// Comprovar si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        // Validar camp email
        $email = $_POST['email'] ?? '';
        if (empty($email)) {
            throw new RequiredFieldException("El camp Email és obligatori.");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("L'email proporcionat no és vàlid.");
        }

        // Validar contrasenyes
        $password = $_POST['password'] ?? '';
        if (empty($password)) {
            throw new RequiredFieldException("La contrasenya és obligatòria.");
        }

        $found = User::login($email,$password);

        // Intentar crear una nova instància de User
        if (!$found){
            throw new PasswordDoNotMatchException("Usuari o contrasenya Incorrectes");
        }


        $_SESSION['userId'] = $found->getId();
        header("Location: index.php");
        exit;

    } catch (RequiredFieldException | InvalidEmailException | PasswordDoNotMatchException  $e) {
        // Capturar les excepcions i mostrar missatges d'error
        echo $e->getMessage();
        exit;
    }
}
include_once 'views/user/login.view.php';
