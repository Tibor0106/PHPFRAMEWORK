<?php
class AuthToken{
    public string $token;
    public string $refreshToken;
    public DateTime $refreshTokenExpires;
    public DateTime $TokenExpires;
    public function __construct(string $token, string $refreshToken, DateTime $refreshTokenExpires, DateTime $TokenExpires) {
       $this->token = $token;
       $this->refreshToken = $refreshToken;
       $this->refreshTokenExpires = $refreshTokenExpires;
       $this->TokenExpires = $refreshTokenExpires;
       $this->TokenExpires = $TokenExpires;
    }
}
?>