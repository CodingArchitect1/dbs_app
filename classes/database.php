<?php
 
    class database{
 
    function opencon(): PDO {
        return new PDO(
            'mysql:host=localhost;
            dbname=detorres_db',
            username:'root',
            password: '');
    }
}
?>
 