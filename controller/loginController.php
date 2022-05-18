<?php

    class loginController extends Logowanie{
        private $uid;
        private $haslo;
        
        public function __construct($uid, $haslo){
            $this->uid = $uid;
            $this->haslo = $haslo;
        }

        public function zalogujUzytkownika(){
            if($this->emptyInput() == false){
                echo "Pusty input!";
                header("location: ../public/indexlogowanie.php?error=pustyinput");
                exit();
            }
            $this->odbierzUzytkownika($this->uid, $this->haslo);
        }

        private function emptyInput(){
            $wynik;
            if(empty($this->uid) || empty($this->haslo)){
                $wynik = false;
            } else{
                $wynik = true;
            }
            return $wynik;
        }
    }