<?php

    class Logowanie extends bdh{
        protected function odbierzUzytkownika($uid, $haslo){
            $stat = $this->connect()->prepare('SELECT uzytkownik_haslo FROM uzytkownicy WHERE uzytkownik_uid = ? OR uzytkownik_email = ?;');
            
            if(!$stat->execute(array($uid, $haslo))){
                $stat = null;
                echo "Statement failed.";
                header("location: ../public/indexlogowanie.php?error=stat0failed");
                exit();
            }

            if($stat->rowCount() == 0){
                $stat = null;
                header("location: ../public/indexlogowanie.php?error=nieznalezionouzytkownika");
                exit();
            }

            $hashowanieHasla = $stat->fetchAll(PDO::FETCH_ASSOC);
            $sprawdzHaslo = password_verify($haslo, $hashowanieHasla[0]['uzytkownik_haslo']);

            if($sprawdzHaslo == false){
                $stat = null;
                header("location: ../public/indexlogowanie.php?error=zlehaslo");
                exit();
            }elseif($sprawdzHaslo == true){
                $stat = $this->connect()->prepare('SELECT * FROM uzytkownicy WHERE uzytkownik_uid = ? OR uzytkownik_email = ? AND uzytkownik_haslo');

                if(!$stat->execute(array($uid, $haslo))){
                    $stat = null;
                    echo "Statement failed.";
                    header("location: ../public/indexlogowanie.php?error=stat1failed");
                    exit();
                }
                if($stat->rowCount() == 0){
                    $stat = null;
                    echo "Statement failed.";
                    header("location: ../public/indexlogowanie.php?error=stat2failed");
                    exit();
                }
                $uzytkownik = $stat->fetchAll(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["uzytkownikid"] = $uzytkownik[0]["uzytkownik_id"];
                $_SESSION["uzytkownikuid"] = $uzytkownik[0]["uzytkownik_uid"];

                $stat = null;
            }

            $stat = null;
        }

    }