<?php

class APIAuthentication {

    public static function ValidateToken($Token): bool {
        if (!isset($_SESSION["expiration"]) || $_SESSION["expiration"] <= date('Y-m-d H:i:s') || $_SESSION["Token"] !== $Token) {
            return false;
        }
        return true; 
    }

    public static function Validate(string $client_user, string $client_pass): bool {
        if ($client_pass === "asd" && $client_user === "asd") {
            $exp = new DateTime('now');
            $exp->add(new DateInterval('PT2M')); 
    
            session_start(); 
            $_SESSION["Token"] = self::getNewToken();
            $_SESSION["expiration"] = $exp->format('Y-m-d H:i:s');
            return true;
        }
        return false;
    }

    public function updateToken() {
        session_start(); 
        $_SESSION["Token"] = self::getNewToken(); 
        $exp = new DateTime('now');
        $exp->add(new DateInterval('PT2M'));
        $_SESSION["expiration"] = $exp->format('Y-m-d H:i:s');
    }

    private static function getNewToken(): string {
        return bin2hex(random_bytes(32));
    }
}

?>
