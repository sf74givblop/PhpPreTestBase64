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
        ?>
        <div id='divBefore'>before</div>
        <img src='img/image1.png' alt='image1'>
        <canvas id='myCanvasImage' width='500' height='500'></canvas>
        <div id='divAfter'>after</div>

        <form method="POST" name="form" id="form">
          <textarea name="base64" id="base64"></textarea>
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
              var image = canvas.toDataURL(); // data:image/png....
              document.getElementById('base64').value = image;
           },false);

        </script>
-->        
       <?php
       
       
       ?>
        
    </body>
</html>