<?php
/*	include 'similarity.php';*/
	
	$conn = mysqli_connect("localhost","root","", "search");
	if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	if (isset($_POST["submit"])) {
	 	# code...
	 	if (!empty($_POST["search"])) {
	 		# code...
	 		$query = str_replace(" ", "+", $_POST["search"]);
	 		header("location: search.php?search=" . $query);
	 	}
	 }

?>
<?php




   

    
/*if( strlen( $search = $_GET [ 'search' ] ) >= 2 )
   echo "<h4>Search term too long </h4><hr>";
else{
	echo "You searched for <b> $search </b> <hr size='1' > </ br > ";
}*/

/*if (isset($_POST["submit"])) {

	 	# code...
	 	if (!empty($_POST["search"])) {
	 		# code...
	 		$query = substr($_POST["search"],0,2);
	 	}

	 } */

/*// limit words number of characters
function limitChars($query, $limit = 2){
    return substr($query,0,$limit);
}
function filter($query){
	$query = isset($_POST["submit"]);
	return limitChars($query);
	
	}*/
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
 		* {
  box-sizing: border-box;
}

/*body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f3f3f3;
  height: auto;
  width: auto;
  margin-bottom: 50px;

}
*/
/* Float four columns side by side */
.column { 
margin-top:100px;
   width: 80%;
  padding: 0 3px;
   margin-left:10%;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: auto;
    display: block;
    height: auto;
    margin-bottom: auto;
    margin-left:auto;

  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  padding: 20px 20px;
  margin-left: 30px;
  margin-right: 30px;
  background-color: #fff;
  height: auto;
  width: auto;
  border-radius: 10px;
/*  margin-bottom: 30px;*/

}
.card-body button[type="submit"]{
        margin-top: 20px;
        border: none;
        outline: none;
        height: 40px;
        background: #008080;
        color: #008080;
        font-size: 18px;
        border-color: #008080;
        border-radius: 20px;
        /*border-bottom: 1px solid #008080*/
}
button:hover{
  opacity: 0.8;
}
/*.container input[type="text"]:hover{
 			cursor: pointer;
    		background: white;
    		color: white;
 		}*/
 	</style>

</head>
<body>
	<?php include 'header.php';
	?>
	<?php include 'nav1.php';
	?>
	<div class="container">
		<form accept-charset="utf-8" method="GET" action="search.php">
			<center>
				<img src="images/1.png" class="img-responsive" alt="Search" width="90" height="90" style="margin-top: 30px;">
			</center>
			<div class="row">
		    	<div class="input-group input-group-lg" style="margin-top: 40px;">
		      		<input type="search" class="form-control" name="search" placeholder="Search using project topic.." value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>" required>
		      		<div class="input-group-btn">
		        		<button class="btn btn-default" type="submit" value="submit" ><i class="glyphicon glyphicon-search" name="search"></i></button>
		      		</div>
		    	</div>
		    	<center>
					<input type="submit" name="submit" value="submit">
				</center>
			</div>
	  	</form>
	  	<br><br>

    	<?php 

    		/*if (isset($_POST["submit"])) {
		 	# code...
		 	if (empty($_POST["search"])) {
		 		# code...
		 		echo "please enter something";
		 	}

		 }

*/
            
	         if(isset($_GET["search"]))
	         {
	         	
       
	          $query = trim(preg_replace('/[^a-z0-9]\s+/i','',$_GET["search"]));
	          
		      $words = array();
		    // expand this list with your words.
		      $list = array("on","an", "design","and", "implementation", "comuter", "for", "statistical", "analysis", "system","of","you","he","me","us","they","she","to","but","that","this","those","then","the", "online", "computerized","its", "study","quality");

              $condition = '';    
               $c = 0;
              foreach(explode(" ", $query) as $key)  
              {  
              	if (in_array($key, $list)){
		            continue;

		        }
		        $words[] = $key;
		        if ($c >= 15){
		            break; 
		        }
			        $c++;

			        foreach ($words as $text) {
			        	# code...
			        	$condition .= "project_topic LIKE '%".mysqli_real_escape_string($conn, $text)."%' OR ";
			     }
			     

			   }
			   
              $condition = substr($condition, 0, -4);  
              $sql = "SELECT * FROM add_project ";
              $sql_query = "SELECT * FROM add_project WHERE $condition";  
              /*$sim = Similarity::($sql_query);*/
              $result2 = $conn -> query($sql);
              $result = $conn -> query($sql_query);

              $num =@mysqli_num_rows($result2);
              $number =@mysqli_num_rows($result);
              if ($number != 0) 
              	# code...
              	 echo '<h4><div class="result-count" style="margin-left: -15px; "> Result
				Found:&nbsp<b style="color: blue;">' .$number. '</b>&nbspResults&nbsp out of <b style="color: blue;">' .$num. '</b>
				&nbspResults 		</div></h4>';
              else{echo '<h4><div class="result-count" style="margin-left: -15px; ">Result
				Found:&nbsp<b style="color: blue;">0</b>&nbspResults out of <b style="color: blue;">'.$num.'</b></div></h4>';
			}
             
				echo '<h4 style="margin-left: -15px; ">You have searched for keywords: <i style="color: blue;">' . $_GET['search'].'</i> </h4><br>';
              if($number > 0)  
              {  
              	
                   while($row = mysqli_fetch_array($result))  
                   {  
                                
	         ?> 

	 </div>
	 


<div class="row " style="margin-top: -80px;">
    
      
  <div class="column">

    <div class="card">
        
          <div class="card-header">
    <h1 style="margin-left: 20px;"><b><?php echo $row['project_topic']; ?></b></h1>
    <hr>
  </div>
  <div class="card-body" style="margin-left: 20px;">
    
    <p class="card-text"><?php echo $row['project_des']; ?></p><br> 

    <h3 style="margin-top: 10px">Project by: <b><?php echo $row['stu_name']; ?></b> &nbsp Supervised by: <b><?php echo $row['supervisor_name']; ?></b></h3><br>
    

    <a href="admin/upload/<?php echo $row['material']?>" download><button type="submit" class="btn btn-outline-primary" style="width: 150px; color: #000; margin-top: 20px;">Download</button></a> &nbsp&nbsp&nbsp&nbsp
  <a href="admin/upload/<?php echo $row['material']?>" target="_blank"><button type="submit" class="btn btn-outline-primary" style="width: 150px; color: #000; margin-top: 20px;">Review</button></a>
 
</div> 

        </div>
        	
</div>
</div>


<?php   }  
}
	              
	              else  
	              {  
	                   echo '<h4 style="margin-left: -30px;">Results not found</h4>';  
	              } 

	        }
	          
	         ?>
</div>
	<?php include 'footer.php';
	?>
</body>
</html>