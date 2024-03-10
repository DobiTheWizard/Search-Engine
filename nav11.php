<!DOCTYPE html>
<html>
<head>
  <title>nav</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" href="../css/jquery.min.js">
  <link rel="stylesheet" href="../css/bootstrap.min.js">
  <link rel="stylesheet"  href="../fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
</head>
<body>

  <!-- Navbar for larger screen like pc and destops-->

  <nav>
    <div class="w3-down">
      <ul class="w3-navbar w3-light-white w3-card-2 w3-left-align ">
          <li class="w3-hide-medium w3-hide-large w3-opennav w3-down">
            <a class="w3-padding-large" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><h6><i class="fa fa-bars"></i></h6></a>
          </li>
          <li class="w3-hide-small w3-right w3-text-black "><a href="javascript:void(0)" class="w3-padding-large w3-hover-red"><h5><i class="fa fa-bars"></i></h5></a></li>

          <li class="w3-hide-small w3-left w3-text-black "><h4><large><p>PSEARCH- PROJ3CT R3S3ARCH</p></large></h4></li>
          <li class="w3-hide-small w3-right w3-text-black "><a href="" class="w3-padding-large"><h5><small><b>TERMS</b></small></h5></a></li>
          <li class="w3-hide-small w3-right w3-text-black "><a href="" class="w3-padding-large"><h5><small><b>HELP</b></small></h5></a></li>
          <li class="w3-hide-small w3-right w3-text-black "><a href="" class="w3-padding-large"><h5><small><b>ABOUT US</b></small></h5></a></li>
          <li class="w3-hide-small w3-right w3-text-black "><a href="" class="w3-padding-large"><h5><small><b><i class="fa fa-home"></i></b></small></h5></a></li>
      </ul>
    </div>


    <!-- Navbar on small screens for phones -->
    <div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-down" style="margin-top:46px">
        <ul class="w3-navbar w3-left-align w3-light-grey">
            <li><a class="w3-padding-large" href=""><small><b>ABOUT US</b></small></a></li>
            <li><a class="w3-padding-large" href=""><small><b>HELP</b></small></a></li>
            <li><a class="w3-padding-large" href=""><small><b>TERMS</b></small></a></li>
        </ul>
    </div>
  </nav>
  <!-- the end of Navbar -->

  <script type="text/javascript">
  
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        }
        else { 
          x.className = x.className.replace(" w3-show", "");
        }
      }
  </script>


</body>
</html>