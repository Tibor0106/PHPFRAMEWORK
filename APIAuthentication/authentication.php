<?php


class APIAuthentication {
   
   

    public static function ValidateToken($Token): bool {

        $databaseAction = new DatabaseAction();  
        $responseHolder = $databaseAction->Select("SELECT * FROM tokne WHERE token like '$Token' AND expire >= NOW()");
        
       $tokenArr = json_decode($responseHolder->response, true);
        if(count($tokenArr) == 0) {
            return false;
        }
       
        return true;
    }
    
    public static function Validate(string $client_user, string $client_pass): bool {
        if ($client_pass === "asd" && $client_user === "asd") {
            $token = self::getNewToken();
            $expiration = date('Y-m-d H:i:s', strtotime('+2 minutes')); // Token lejárati ideje: jelenlegi idő + 2 perc
            $databaseAction = new DatabaseAction();
            // Token és lejárati idő beszúrása az adatbázisba
            $responseHolder = $databaseAction->Insert("INSERT INTO tokne (token, expire, client_ip) VALUES ('$token', '$expiration', '-')");
            http_response_code($responseHolder->state_code);
            $_SESSION["Token"] = $token;
            return true; 
        }
        return false;
    }

    private static function getNewToken(): string {
        return bin2hex(random_bytes(32)); // Visszaad egy 32 bájtos (64 hexadecimális karakterből álló) véletlen tokent
    }
}

?>
