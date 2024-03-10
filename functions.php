<?php 
	
	function excape($string) {
		
		echo isset($_POST[$string]) ? htmlentities($_POST[$string],  ENT_QUOTES, 'UTF-8') : "";
		
	}
	
	function escape($string) {
		
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
		
	}
	function error($message) {
	 echo "<div class='col-lg-12 alert alert-danger' style='padding:10px'><i class='fa fa-warning'></i> $message</div>";
 }


 function errorArray($message) {
 	 echo "<div class='col-lg-12 alert alert-danger' style='padding:10px'><i class='fa fa-warning'></i>";
 	 echo "<b> The following error(s) occured.</b><ol>";
 	 foreach($message as $m)
 	 	 echo "- ".$m."<br/>";
	 	 echo "</ol>";
	 	 echo "</div>";

 }
  function success($message) {
	 echo "<div class='col-lg-12 alert alert-success' style='padding:10px'><i class='fa fa-information'></i> $message</div>";
 }
?>