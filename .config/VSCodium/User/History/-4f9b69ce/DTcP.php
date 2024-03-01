<?php
if(!isset($_SESSION["nome"])) {
    if(isset($_COOKIE["rmbr_me"])) {
        // Has no session, but has remember_me
        // We need to verify it's correctness and create session
        
        // puts name, surname, expire_date in $user_data 
        // if cookie value is found
        require "get_cookie_expire_date.php";
        
        // check expire date of cookie
        if($user_data->data_scadenza > date('Y-m-d H:i:s')) {
            // the cookie is valid
            // create session
            $_SESSION["nome"] = $user_data->nome;
            $_SESSION["cognome"] = $user_data->cognome;
            echo("<h1 class=\"confirmation\"> TEST: Created session from cookie </h1>");
        }
        else {
            // the cookie is not valid
            // remove it from database
            require "remove_rmbr_me_from_table.php";
            // delete cookie
            if(!setcookie("rmbr_me", "", time()-3600))
                throw new Exception("<h1 class=\"error\">Unexpected Error, could not destroy expired cookie</h1>");
            // redirect to login
            header("Location: login.php"); 
            exit();
        }
    }
    else {
        // no session, no remember me, needs to login
        header("Location: login.php"); 
        exit();
    }
}   
?>