<?php
namespace App\Models;


class Password {
    const SALT = 'EstoEsUnSalt';
    
    public static function hash($password) {
        return hash('sha512', self::SALT . $password);
    }
    public static function verify($password, $hash) {
        return ($hash == self::hash($password));
    }
}

