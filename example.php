<?php
include "dbconnect.php";

//specify how many results to display per page
$limit = 10;

//get the search variable from URL
extract($_GET);
$var=$q;

//set keyword character limit
if(strlen($var) < 3){
    $resultmsg =  "<p>Search Error</p><p>Keywords with less then three characters are omitted...</p>" ;
}

//trim whitespace from the stored variable
$trimmed = trim($var);
$trimmed1 = trim($var);

//separate key-phrases into keywords
$trimmed_array = explode(" ",$trimmed);
$trimmed_array1 = explode(" ",$trimmed1);

// check for an empty string and display a message.
if ($trimmed == "") {
    $resultmsg =  "<p>Search Error</p><p>Please enter a search...</p>" ;
}

// Build SQL Query for each keyword entered
foreach ($trimmed_array as $trimm){
// EDIT HERE and specify your table and field names for the SQL query
// MySQL "MATCH" is used for full-text searching. Please visit mysql for details.
$query = "SELECT * , MATCH (title,body,abstract) AGAINST ('".$trimm."') AS score FROM project WHERE MATCH (title,body,abstract) AGAINST ('+".$trimm."') ORDER BY score DESC";

// Execute the query to  get number of rows that contain search kewords
  $numresults = mysqli_query ($db,$query);
 $row_num_links_main = @mysqli_num_rows ($numresults);

//If MATCH query doesn't return any results due to how it works do a search using LIKE
 if($row_num_links_main < 1){
    $query = "SELECT * FROM project WHERE title LIKE '%$trimm%' OR body LIKE '%$trimm%' OR abstract LIKE '%$trimm%'  ORDER BY title DESC";
    $numresults=mysqli_query ($db,$query);
    $row_num_links_main1 =@mysqli_num_rows ($numresults);
	} 
	
// next determine if 's' has been passed to script, if not use 0.
 // 's' is a variable that gets set as we navigate the search result pages.
 if (empty($s)) {
     $s=0;
 }


 // now let's get results.
  $query .= " LIMIT $s,$limit" ;
  $numresults = mysqli_query ($db,$query) or die ( "Couldn't execute query" );
  $row= mysqli_fetch_array ($numresults);

  //store record id of every item that contains the keyword in the array we need to do this to avoid display of duplicate search result.
  do{
      $adid_array[] = $row[ 'matric' ];
  }while( $row= mysqli_fetch_array($numresults));
} //end foreach


//Display a message if no results found
if($row_num_links_main == 0 && $row_num_links_main1 == 0){
    $resultmsg = "<p>Search results for: ". $trimmed."</p><p>Sorry, your search returned zero results</p>" ;
}

//delete duplicate record id's from the array. To do this we will use array_unique function
$tmparr = array_unique($adid_array);
$i=0;
foreach ($tmparr as $v) {
   $newarr[$i] = $v;
   $i++;
}

//total result
$row_num_links_main = $row_num_links_main + $row_num_links_main1;

// now you can display the results returned. But first we will display the search form on the top of the page
echo '<form action="search.php" method="get">
<div>
<input id="con_name" name="q" type="text" value="'.$var.'">
<input id="login-submit" name="search" type="submit" value="Search">
</div>
</form>';
?>
<div align="left" class="style1">Search By: <a href="index_supervisor.php">Supervisor</a>&nbsp;&nbsp;<a href="index_student.php">Student  </a>&nbsp;&nbsp;<a href="index_matric.php">Matric </a>&nbsp;&nbsp;<a href="index_year.php">Year </a></div>

<?php // display an error or, what the person searched
if( isset ($resultmsg)){
    echo $resultmsg;
}else{
    echo "<p>Search results for: <strong>" . $var."</strong></p>";

    foreach($newarr as $value){
	
	// EDIT HERE and specify your table and field unique ID for the SQL query
    $query_value = "SELECT * FROM project WHERE matric = '".$value."'";  
    $num_value=mysqli_query ($db,$query_value);
    $row_linkcat= mysqli_fetch_array ($num_value);
    $row_num_links= mysqli_num_rows ($num_value);
	
	//create summary of the long text. For example if the field2 is your full text grab only first 130 characters of it for the result
	$size = 300;
    $introcontent = strip_tags($row_linkcat[ 'abstract']);
	$introcontent =substr($introcontent, strpos($introcontent, $var) - $size, strpos($introcontent, $var) + sizeof($var) + $size).'...';

    //$introcontent = substr($introcontent, 0, 400)."...";	
	
	//now let's make the keywods bold. To do that we will use preg_replace function.
    //Replace field
      $title = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $row_linkcat[ 'Title' ] );
	  $supervisor = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $row_linkcat[ 'supervisor' ] );
	  $date = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $row_linkcat[ 'date' ] );
	  $name = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $row_linkcat[ 'Name' ] );
      $desc = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $introcontent);
      $link = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" ,  $row_linkcat[ 'Title' ]  );
	  $matric =  $row_linkcat[ 'matric' ];
	
	
	   foreach($trimmed_array as $trimm){
            if($trimm != 'b' ){
                $title = preg_replace( "'($trimm)'si" ,  "<strong>\\1</strong>" , $title);
                $desc = preg_replace( "'($trimm)'si" , "<strong>\\1</strong>" , $desc);
                $link = preg_replace( "'($trimm)'si" ,  "<strong>\\1</strong>" , $link);
             }//end highlight
        }//end foreach $trimmed_array
		
		//format and display search results?>
<table width="615" border="0" cellpadding="1" cellspacing="1">
<tr>
<th scope="col"><div align="left" class="title" id="title"><a href="downloadfile.php?id=<?php echo "$matric"; ?>"><?php echo "$title"; ?> | <?php echo "$supervisor"; ?> | <?php echo "$date"; ?></a></div></th>
</tr>
<tr>
<td><div align="left" class="snippet" id="snippet"><?php echo "$desc"; ?></div></td>
</tr>
<tr>

<td><div align="left" class="link" id="link"><a id = "link2" href="downloadfileTEXT.php?id=<?php echo "$matric"; ?>"><?php echo "$link"; ?> | <?php echo "$name"; ?> | .doc version</a></div>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>

<?php }  //end foreach $newarr

    if($row_num_links_main > $limit){
    // next we need to do the links to other search result pages
        if ($s >=1) { // do not display previous link if 's' is '0'
            $prevs=($s-$limit);
            echo '<div class="search_previous"><a href="'.@$PHP_SELF.'?s='.$prevs.'&q='.$var.'">Previous</a>
</div>';
        }
    // check to see if last page
        $slimit =$s+$limit;
        if (!($slimit >= $row_num_links_main) && $row_num_links_main!=1) {
            // not last page so display next link
            $n=$s+$limit;
            echo '<div  class="search_next"><a href="'.@$PHP_SELF.'?s='.$n.'&q='.$var.'">Next</a>
</div>';
        }
    }//end if $row_num_links_main > $limit
}//end if search result
?>
	
