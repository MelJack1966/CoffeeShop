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




//print_r($_SESSION['cart']);
        ?>

<div class="small-container">
	<h2 class="title">Thank you for your order!</h2>
		<div class="row">


		</div>
	</div>
        
  
            <?php
          


    //<!--------- FOOTER --------->
    include("static/footer.html");
    ?>
</html>
