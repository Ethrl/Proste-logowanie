<?php

    class bdh{
        protected function connect(){
            try{
                $username = "root";
                $password = "";
                $bdh = new PDO('mysql:host=localhost;dbname=Studencik', $username, $password); //Tutaj wpisz swoją baze danych i połącz ją
                return $bdh;
            } 
            catch(PDOExcepcion $err){
                print "Error: ".$err->getMessage()."<br/>";
                die();
            }
        }
    }