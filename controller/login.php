<?php

    if(isset($_POST["submit"])){

        //pozyskiwanie danych
        $uid = $_POST["uid"];
        $haslo = $_POST["haslo"];


        //inicjowanie klas
        include "../model/bdhModel.php";
        include "../model/loginModel.php";
        include "../controller/loginController.php";
        $login = new loginController($uid, $haslo);

        //errory
        $login->zalogujUzytkownika();

        //powrot do glownej strony
        header("location: ../public/indexlogowanie.php?error=0");
    }