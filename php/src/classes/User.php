<?php

namespace Damero;

use Damero\Exempcions\WeekPasswordException;

/**
 * Classe que representa un Usuari
 *
 * L'usuari dona d'alta els llibres que vol vendreexit,
 * de manera que podem llogar i retornar productes mitjançant les operacions
 * homònimes.
 *
 * @package BatBook\User
 * @author Aitor Medrano <a.medrano@edu.gva.es>
 */

class User
{
    public static string $nameTable = 'usuaris';
    private $id;
    public function __construct(
        private string $email='',
        private string $password='',
        private string $nick=''
    ) {
        if ($password !== '') {
            $this->setPassword($password);
        }
    }

    // Setters
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        if (! $this->isValidPassword($password)) {
            throw new WeekPasswordException(
                'La contrasenya ha de tindre almenys 8 caràcters, una lletra majúscula, una minúscula i un número.'
            );
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($hashedPassword === false) {
            throw new \RuntimeException('Error xifrant la contrasenya.');
        }

        $this->password = $hashedPassword;
    }


    public function setNick(string $nick): void
    {
        $this->nick = $nick;
    }

    // Getters
    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function getId(): int
    {
        return $this->id;
    }

    // __toString Method
    public function __toString(): string
    {
        return "<div class='user'>
                    <h3>Nick: $this->nick</h3>
                    <h6>Email: $this->email</h6>
                </div>";
    }

    // Validate Password Complexity
    private function isValidPassword(string $password): bool
    {
        $hasEightCharacters = strlen($password) >= 8;
        $hasUpperCaseLetter = preg_match('/[A-Z]/', $password);
        $hasLowerCaseLetter = preg_match('/[a-z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);

        return $hasEightCharacters && $hasUpperCaseLetter && $hasLowerCaseLetter && $hasNumber;
    }

    protected function toArray(){
        return [
            'email' => $this->email,
            'password' => $this->password,
            'nick' => $this->nick,
        ];
    }

    protected function visible(){
        return [
            'email' => $this->email,
            'nick' => $this->nick,
        ];
    }


    public function save()
    {
        if ($id = QueryBuilder::insert(User::class,$this->toArray())){
            return $id;
        } else {
            return null;
        }
    }

    public function toJson(): string
    {
        return json_encode($this->visible());
    }

    public static function login($email,$password)
    {

        $user = QueryBuilder::sql(User::class, ['email' => $email])[0];
        if (password_verify($password,$user->getPassword())){
            return $user;
        }
        return false;
    }

    public static function logout(){
        $user = QueryBuilder::find(User::class,$_SESSION['userId']);
        $_SESSION['userId'] = null;
    }

    public static function find($id)
    {
        return QueryBuilder::find(User::class,$id);
    }
}


