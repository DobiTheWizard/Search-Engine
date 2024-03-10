<?php
	
	
	$conn = mysqli_connect("localhost","root","", "search");
	if (isset($_POST["submit"])) {
	 	# code...
	 	if (empty($_POST["search"])) {
	 		# code...
	 		/*$query = str_replace(" ", "+", $_POST["search"]);
	 		header("location: search.php?search=" . $query);*/
	 		echo "empty";
	 	}
	 }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Psearch -Research search engine</title>
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/flaticon/font/flaticon.css">
 	<link rel="stylesheet"  href="fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

 	<style type="text/css">
 		.container input[type="submit"]{
		    margin-top: 40px;
		    border: none;
		    outline: none;
		    height: 40px;
		    width: 40%;
		    background: transparent;
		    color: #008080;
		    font-size: 18px;
		    border-color: #008080;
		    border-radius: 20px;
		    border-bottom: 1px solid #008080
		}
 		.container input[type="submit"]:hover{
 			cursor: pointer;
    		background: #008080;
    		color: #000;
 		}
 	
 	</style>

</head>
<body>
	<?php include 'header.php';
	?>
	<?php include 'nav1.php';
	?>
	<div class="container">
		<form action="search2.php"  method="POST">
			<center>
				<img src="images/1.png" class="img-responsive" alt="Search" width="90" height="90" style="margin-top: 30px;">
			</center>
			<div class="row">
		    	<div class="input-group input-group-lg" style="margin-top: 40px;">
		      		<input type="text" class="form-control" name="search" placeholder="Search using project topic..">
		      		<div class="input-group-btn">
		        		<button class="btn btn-default" type="submit" value="search" ><i class="glyphicon glyphicon-search" name="search"></i></button>
		      		</div>
		    	</div>
		    	<center>
					<input type="submit" name="submit" value="search">
				</center>
			</div>
	  	</form>
	  </div>
	  <br>
	  <br>

	  <?php
        
      
 
       if(! $_GET [ 'submit' ])
             echo "you didn't submit a keyword";

       else {
             if( strlen( $search = $_GET [ 'search' ] ) >= 20 )
                    echo "<h4>Search term too long </h4><hr>";
             else {
                    echo "You searched for <b> $search </b> <hr size='1' > </ br > ";
                    $con = mysqli_connect( "localhost","root","", "search") ; 


                   
 					$construct = "";
                    $search_exploded = explode ( " ", $search );
                    $x = 0; 
                    foreach( $search_exploded as $search_each ) {
                           $x++;
                           
                           if( $x == 1 )
                                  $construct .="project_topic LIKE '%$search_each%'";
                           else
                                  $construct .="OR project_topic LIKE '%$search_each%'";
                    }
 
                    $construct = " SELECT * FROM add_project WHERE $construct ";
                    $run = mysqli_query($con, $construct) or die("Sorry, there are no matching result for <b> $search </b>. </br> </br> 1. Try more general words.</br> Try different words with similar  meaning </br> 3. Please check your spelling");
 
                    $foundnum = mysqli_num_rows($run);
 
                    if ($foundnum == 0)
                           echo "Sorry, there are no matching result for <b> $search </b>. </br> </br> 1. Try more general words. </br> 2. Try different words with similar  meaning </br> 3. Please check your spelling"; 
                    else {
                           echo "$foundnum results found !<p>";
 
                           while( $runrows = mysqli_fetch_assoc( $run ) ) {
                                  $title = $runrows ['project_topic'];
                                  $desc = $runrows ['supervisor_name'];
                                  $url = $runrows ['stu_name'];
 
                                  echo "<a href='$url'> <b> $title </b> </a> <br> $desc <br> <a href='$url'> $url </a> <p>";
 
                           }
                    }
 
             }
       }
 ?>

	  	<br><br>
	<?php include 'footer.php';
	?>
</body>
</html>