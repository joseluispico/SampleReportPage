<?php
//Database connection
$host = "localhost";
$user = "root";
$pass = "root";
$db = "enrolment";

$con = mysqli_connect($host,$user,$pass,$db);
// Define database to be encoded in utf8
//$con->set_charset('utf8');

// Check connection
if(!$con){
    //die("ERROR: Could not connect. " . mysqli_connect_error());
	echo "Connection Failed. Try again " . mysqli_connect_errno() . PHP_EOL; exit;
}
?>
<html>
<head>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sample Report Page</title>
    <script type='text/javascript'>
	document.oncontextmenu = function(){return false}
    </script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.fixedHeader.min.js"></script>

      <style>
        thead input {
        width: 100%;
    }
      </style>
      
	  <link rel='stylesheet' href='css/jquery.dataTables.min.css' type='text/css' media='all' />
      <link rel='stylesheet' href='css/fixedHeader.dataTables.min.css' type='text/css' media='all' />
      <link href="css/font-awesome.css" rel="stylesheet">
      <link href="css/bootstrap.css" rel="stylesheet">

<div class="col-md-12">

<br>
<br>

<table id="data" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<body>

 <?php
 //Select query execution
$sql="SELECT en.student_id, 
             us.first_name,
  			 us.last_name,
			 co.Description,
			 en.status
			 FROM enroll en INNER JOIN users us ON en.student_id = us.student_id JOIN courses co ON en.id_course = co.id_course";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
	while ($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['student_id'] . "</td>";
		echo "<td>" . $row['first_name'].' '. $row['last_name'] . "</td>";
		echo "<td>" . $row['Description'] . "</td>";
		echo "<td>" . $row['status'] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
 }
else
{
    ?>
    <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Empty Registers</td></tr>
    <?php
}
    ?>
  </tbody>
 </table>
</div>

<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#data thead tr').clone(true).appendTo( '#data thead' );
    $('#data thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#data').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );
</script>
</body>
</html>