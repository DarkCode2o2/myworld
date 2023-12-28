<?php 

    $dsn = "mysql:host=localhost;dbname=darkworld";
    $user = 'root';
    $pass = '';


    try {

        $con = new PDO($dsn, $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // Function to check is the token in the browser match the token in the database

    if(! function_exists('checker')) {

        function checker() {
            global $con; 


            if(isset($_COOKIE['token'])) {
                $get = $con->prepare("SELECT user_id, token FROM users WHERE token = ? AND user_id = ?");
                $get->execute(array($_COOKIE['token'],$_COOKIE['userid']));
                $count = $get->rowCount();

                return $count;
            }
        }
    }

?>