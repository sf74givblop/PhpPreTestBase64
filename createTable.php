<?php

            $servername = "127.0.0.1:3306";
            $username = "root";
            $password = "";   //test
            $db = "dbserge";
            $table="img_source";
            
            // Create connection to create the db
            $conn = new mysqli($servername, $username, $password);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error . "<br>");
            } 

            // Create database
            $sql = "CREATE DATABASE IF NOT EXISTS ".$db;
            if ($conn->query($sql) === TRUE) {
                echo "Database ".$db." created successfully<br>";
            } else {
                die("Error creating database: " . $conn->error . "<br>");
            }
            $conn->close();
            
            
            // Create connection to create the table
            $connT = new mysqli($servername, $username, $password, $db);
            // Check connection
            if ($connT->connect_error) {
                die("Connection failed: " . $connT->connect_error . "<br>");
            } 
            // Create table
            $sqlT = "CREATE TABLE IF NOT EXISTS `$table` (

                    `id` int(11) NOT NULL AUTO_INCREMENT,

                    `base64` longtext COLLATE utf8_unicode_ci NOT NULL,

                     PRIMARY KEY (`id`)

                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
                    
                   ";

            if ($connT->query($sqlT) === TRUE) {
                echo "Table ".$table." created successfully";
            } else {
                die("Error creating table: " . $connT->error);
            }

            $connT->close();
?>


