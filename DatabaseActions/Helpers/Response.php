<?php
   class Response {
    public $response;
    public $state_code;
    public function __construct($response, $state_code) {
        $this->response = $response; 
        $this->state_code = $state_code;
    }
}
?>