<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Serge Frezier's test</title>
    </head>
    <body>
        <?php
            $user_ip=$_SERVER["REMOTE_ADDR"];
            echo 'IPV6 127.0.0. -> '.$user_ip.'<br />';
            $imgHolder='';
        ?>
        <canvas id='myCanvasImage' width='400' height='400'></canvas>

        <form method="POST" name="form" id="form">
            <!-- Just a place holder -->
          <textarea name="base64" id="base64" style="width:100px; min-height:30px;"></textarea>
          <button type="submit">
            Send image
          </button>
        </form>

        <script>
          var canvas = document.getElementById('myCanvasImage');
          var context = canvas.getContext('2d');
          var imageObj = new Image();

          imageObj.onload = function() {
            context.drawImage(imageObj, 69, 50);
          };
          imageObj.src = 'img/image2.png';
        </script>

        <script>

           // on the submit event, generate a image from the canvas and save the data in the textarea
           document.getElementById('form').addEventListener("submit",function(){
              var canvas = document.getElementById("myCanvasImage");
              var imageText = canvas.toDataURL(); // data:image/png....  
              alert(imageText);
              document.getElementById('base64').value = imageText;
           },false);

        </script>
       
       <?php
         
       //echo $_POST['base64'];
       $baseFromJavascript=$_POST['base64'];
       
       $base_to_php = explode(',', $baseFromJavascript);
//echo count($base_to_php).'<br/>';  //2
//echo $base_to_php[0].'<br/>';  //data:image/png;base64
//echo $base_to_php[1].'<br/>';  //iVBORw0KGgoAAAANSUhEUgAAAZAAAAGQCAY...
       
       //$base_to_php = explode(',', $baseFromJavascript);
        // the 2nd item in the base_to_php array contains the content of the image
        //$data = base64_decode($base_to_php[1]);
        //echo $data;
        // here you can detect if type is png or jpg if you want
        //$filepath = "/path/to/my-files/image.png"; // or image.jpg
       
       //we want to insert in database
       //INSERT INTO `img_source` (`id`, `base64`) VALUES (NULL, 'asasdfasdcfasdcfsdfasdfas');
       //INSERT INTO `img_source` (`id`, `base64`) VALUES (NULL, $base_to_php[0].'~~~~'.$base_to_php[1]);
            $servername = "127.0.0.1:3306";
            $username = "root";
            $password = "";   //test
            $db = "dbserge";
            $table="img_source";
            
            // Create connection
            $connI = new mysqli($servername, $username, $password, $db);
            // Check connection
            if ($connI->connect_error) {
                die("Connection failed: " . $connI->connect_error);
            } 
            //I do not save $base_to_php[0]  -> data:image/png;base64
            $sqlI = "INSERT INTO `$table` (`id`, `base64`) VALUES (NULL,'".urlencode($base_to_php[1])."')";
//echo $sqlI."<br />";
            if ($connI->query($sqlI) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sqlI . "<br>" . $connI->error;
            }

            $connI->close();
       ?>
        
        
       <!-- Display all images we saved one after the other -->
       <?php
            // Create connection
//echo $servername."<br />";  //just to check
            $connD = new mysqli($servername, $username, $password, $db);
            // Check connection
            if ($connD->connect_error) {
                die("Connection failed: " . $connD->connect_error);
            } 

            $sqlD = "SELECT id, base64 FROM ".$table;
//echo $sqlD."<br />";
            $resultD = $connD->query($sqlD);

            if ($resultD->num_rows > 0) {
                // output data of each row
                while($rowD = $resultD->fetch_assoc()) {
                    $data=urldecode($rowD["base64"]);
                    $data_ID=$rowD["id"];
                    //no need to use the headers with that
                    if($data!=NULL){
                        echo '<img src="data:image/png;base64,' . $data . '" id="' . $data_ID . '"/>';
                    }
                    else {
                        echo 'An error occurred created an image.<br>';
                    }
              
                }
            } else {
                echo "Empty table: 0 results<br />";
            }
            $connD->close();
       ?>
        
    </body>
</html>