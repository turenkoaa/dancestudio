<?php
    
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login == 'admin' and $password=='12211995')
    {
        header ('Location: dancestudio.php');
    } else {
        echo 'Сначала зарегестрируйтесь';
    }



?>  