<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{

    echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>about</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>


        <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

/*for background image*/
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("bg_image.jpg");

  /* Full height */
  height: 50%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}


</style>

    </head>


    <body>


    <ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="find-result.php">Student Result</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="admin.php">Admin</a></li>
   </ul>


   <!-- about section  -->
   <div>
   <h1 align="center">Web Soul</h1>
   

   <!-- <p align="justify style="color:blue; text-align:center;"> ABOUT US Rangamati Science and Technology University (RMSTU) is the first public university in Chittagong Hill Tracts (CHTs) region with a vision to provide quality scientific and technical education, coherence harmony and inspiring achievement.
                         The university was established in Rangamati by an Act ‘/Rangamati Science and Technology University/’ promulgated on July 15, 2001.
                         Immediately after promulgation of the act, preliminary activities under a project were started.
                         But the university could not come into being as activities of the project were shifted to other district due to political decision.
                          After assuming power in 2008 the present Awami government again initiated to establish the university under the same act.
                        In line with this decision the “Rangamati Science and Technology University Establishment Project” was approved at the Executive Committee of the National Economic Council (ECNEC) on February 19, 2013.
                         The Honorable Prime Minister Sheikh Hasina formally inaugurated the university on February 23, 2013 with a view to expanding modern scientific and technical education in the CHTs as well as to cater the demand of the country.
                          The Honorable Prime Minister put forward a line of directives and guidelines to follow in upgrading the physical infrastructure of the university. Directives include construction of buildings preserving the natural environment and ecology keeping the hills undamaged and the architectural design should be framed as per Bhutan’s architectural sculpt.
                        As per the provision of the act the university will be established at Jhagrabil mouza of Rangamati sadar upazila located to 8-9 kilometers south of Rangamati township. The district administration at first stage, acquired 63.725 acres of specified 100 acres of land at Jhagrabil mouza and Deputy Commissioner Md.
                         Manzarul Mannan handed over the land to Vice Chancellor Professor Dr. Pradanendu Bikash Chakma in the presence of Professor Abdul Mannan, Chairman of Bangladesh University Grants Commission on November 4, 2017.
                          Currently the temporary administrative building is located at complex of Chittagong Hill Tracts Development Board, Vedvedi, Rangamati. Academic activities are being carried out in premises of two local educational institutions on hire basis.
                          The academic activities of RMSTU from 2014-2015 sessions began on November 9, 2015.</p> -->
                          <img style="align=center;" src="images/aboutaa.jpg"  alt="about" width="100%" height="600">

   </div>
   <h3 align="center"> Department of COMPUTER SCIENCE AND ENGINEERING </h3>
   <h3 align="center">RANGAMATI SCIENCE AND TECHNOLOGY UNIVERSITY </h3>


        <p class="text-muted text-center"><small>Copyright © 2022  Web Soul   </a></small> </p>

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>




