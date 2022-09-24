<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Result</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="content-container">

         
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12">
                                    <h2 class="title" align="center">Result</h2>
                                </div>
                            </div>
                            <!-- /.row -->
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
<?php

$rollid=$_POST['rollid'];
$classid=$_POST['class'];
$_SESSION['rollid']=$rollid;
$_SESSION['classid']=$classid;
$qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.Year,tblclasses.Semester from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   ?>
<p><b>Student Name :</b> <?php echo htmlentities($row->StudentName);?></p>
<p><b>Student Id :</b> <?php echo htmlentities($row->RollId);?>
<p><b>Student Class:</b> <?php echo htmlentities($row->Year);?>(<?php echo htmlentities($row->Semester);?>)
<?php }

    ?>
                                            </div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered">
                                                <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Subject</th>    
                                                            <th>Marks</th>
                                                            <th>Letter Grade</th>
                                                            <th>Grade Point</th>
                                                            <th>credits</th>
                                                        </tr>
                                               </thead>
  


                                                	
                                                	<tbody>
<?php                                              
// Code for result

 $query ="select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,tblsubjects.SubjectName,tblsubjects.SubjectCredits from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
$query= $dbh -> prepare($query);
$query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 

foreach($results as $result){

    ?>

<?php
$lettergrade = "";
$gradepoint = "";
$t=$result->marks;
//$t -> marks;

if ( $t >= "80") {
  $lettergrade = "A+";
  $gradepoint = "4.00";
} elseif ($t >= "75") {
    $lettergrade = "A";
    $gradepoint = "3.75";
}
elseif ($t >= "70") {
    $lettergrade = "A-";
    $gradepoint = "3.50";
}
elseif ($t >= "65"){
    $lettergrade = "B+";
    $gradepoint = "3.25";
}
    elseif ($t >= "60") {
    $lettergrade = "B";
    $gradepoint = "3.00";
}elseif ($t >= "55") {
    $lettergrade = "B-";
    $gradepoint = "2.75";
}elseif ($t >= "50") {
    $lettergrade = "C+";
    $gradepoint = "2.50";
}elseif ($t >= "45") {
    $lettergrade = "C";
    $gradepoint = "2.25";
}elseif ($t >= "40") {
    $lettergrade = "D";
    $gradepoint = "2.00";
} else {
    $lettergrade = "F";
    $gradepoint = "0.00";
}
?>

                                                		<tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                			<td><?php echo htmlentities($result->SubjectName);?></td>
                                                			<td><?php echo htmlentities($totalmarks=$result->marks);?></td>
                                                            <td><?php echo htmlentities($lettergrade);?></td>
                                                            <td><?php echo htmlentities($gradepoint);?></td>
                                                            <td><?php echo htmlentities($totalcredits=$result->SubjectCredits);?></td>
                                                		</tr>
<?php 

$creditscount+=$totalcredits;
$totalpoint = ($gradepoint*$totalcredits);
$pointcount+=$totalpoint;


$totlcount+=$totalmarks;
$cnt++;}
?>
                                            <tr>
                                                <th scope="row" colspan="2">Credit Taken</th>
                                                <td><b><?php echo htmlentities($creditscount); ?></b></td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="2">Result</th>
                                                <td><b><?php echo htmlentities($pointcount/$creditscount); ?></b></td>
                                            </tr>
<?php
$t=$pointcount/$creditscount;
$lettergrade = "";

if ( $t >= "4.00") {
    $lettergrade = "A+";
    //$gradepoint = "4.00";
  } elseif ($t >= "3.75") {
      $lettergrade = "A";
      //$gradepoint = "3.75";
  }
  elseif ($t >= "3.50") {
      $lettergrade = "A-";
      //$gradepoint = "3.50";
  }
  elseif ($t >= "3.25"){
      $lettergrade = "B+";
      //$gradepoint = "3.25";
  }
      elseif ($t >= "3.00") {
      $lettergrade = "B";
      //$gradepoint = "3.00";
  }elseif ($t >= "2.75") {
      $lettergrade = "B-";
      //$gradepoint = "2.75";
  }elseif ($t >= "2.50") {
      $lettergrade = "C+";
      //$gradepoint = "2.50";
  }elseif ($t >= "2.25") {
      $lettergrade = "C";
      //$gradepoint = "2.25";
  }elseif ($t >= "2.00") {
      $lettergrade = "D";
      //$gradepoint = "2.00";
  } else {
      $lettergrade = "F";
      //$gradepoint = "0.00";
  }

  

?>
                                            <tr>
                                                <th scope="row" colspan="2">GPA</th>
                                                <td><b><?php echo htmlentities($lettergrade); ?></b></td>
                                            </tr>
                                                    

 <?php } else { ?>     
<div class="alert alert-warning left-icon-alert" role="alert">
                                            <strong>Notice!</strong> Your result not declare yet
 <?php }
?>
                                        </div>
 <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
strong>Oh snap!</strong>
<?php
echo htmlentities("Invalid Roll Id");
 }
?>
                                        </div>



                                                	</tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">
                                                           
                                                            <div class="col-sm-6">
                                                               <a href="index.php">Back to Home</a>
                                                            </div>
                                                        </div>

                                </div>
                                <!-- /.row -->
  
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                  
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
