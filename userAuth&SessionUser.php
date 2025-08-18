<?php
    class UserSession{
        public function __construct() {
            if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        }

        public function setUserId() {
           $_SESSION['user_id'] = '404010'; // Example user ID, replace with actual session management
        }
        public function getUserId() { 
            return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $this->setUserId();
        } 

        public function destroy() {
            session_unset();
            session_destroy();
        }

        

        
    }
    $userSession = new UserSession();
    
?>