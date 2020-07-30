<?php
    session_start();
    require_once dirname(__FILE__).'/../models/User.php';
    
    if (!isset($_SESSION['user'])){ 
        header('location: login_ctrl.php');
        // stop l'execution du script
        exit();
    }

    $user = new User($_SESSION['user']['id_users']);
    $userInfo = $user->readSingle();
    require_once dirname(__FILE__).'/../views/profil_user.php';