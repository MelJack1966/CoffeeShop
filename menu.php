<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CoffeBot Search</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    </head>
    <body>
        <?php
            //header
            session_start();
            include "dynamic/DBController.php";
            $keyword_err = $keyword = "";
            if (isset($_SESSION['loggedin'])){
                if ($_SESSION['loggedin'] == 1) { 
                    if ($_SESSION['role'] == 1) {
                        include("static/header3.html");
                    }else {
                        include("static/header2.html");
                    }
                } else {
                    include("static/header1.html");
                }
            } else {
                include("static/header1.html");
            }       





        ?>

<div class="small-container">
		<h2 class="title">Coffebot Menu   </h2>
        <img src="images/menu.png"> <img src="images/'.$row['picture'].'">
		<div class="row">

<?php
$x=0;
$sql="SELECT distinct name, picture FROM ics325fa2113.menu;";
foreach($pdo->query($sql)as $row){
    echo '<div class="col-4">
    <img src="images/'.$row['picture'].'">
    <h4>'.$row['name'].'</h4>
<label for="size">size</label>
    <select id="size'.$x.'" name="size'.$x.'"> 
    <option value=12>12</option>
    <option value=16>16</option>
    <option value=20>20</option>
    </select>
    <input type=button value="Add to Cart" onclick="addtocart(\''.$row['name'].'\',$(\'#size'.$x.'\').val())";>

</div>';
$x++;   
}


?>




			
		</div>
		
        <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>		
	</div>
        
  
            <?php
          


    //<!--------- FOOTER --------->
    include("static/footer.html");
    ?>
</html>
<script>
    function addtocart(name,size){
        // alert(size);
        $.ajax({
            type:'post',
            url:'addtocart.php',
            data:{'name':name,'size':size},
            success:function(output){
               // alert(output);
            }
        });

    }
    </script>