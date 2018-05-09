<?php session_start(); ?>
<?php			

$pho_id = $_GET['pho_id'];

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
$query = "select pho_id, name, nationalty, experience, style from PHOTOGRAPHER where pho_id= :pho_id";
//$stmt = $db->prepare('SELECT * FROM events WHERE pho_id= :pho_id AND NOT ((end <= :start) OR (start >= :end))');


$stmt = $db->prepare($query);
$stmt->bindParam(':pho_id', $pho_id);

$stmt->execute();
$result = $stmt->fetchAll();

$username = "";
$count =0;

foreach($result as $row) {

$pho_name = $row[name];

//echo $row[name]."<br />";
//echo $row[nationalty]."<br />";
//echo $row[naexperienceme]."<br />";
//echo $row[style]."<br />";
  $count++;
  /*
  $query2 = "select * from extra_serviecs";
  $stmt2 = $db->prepare($query2);

	$stmt2->execute();
	$result2 = $stmt2->fetchAll();
	foreach($result2 as $row2) {
	}*/
	
	$query3 = "select price from price where price_type=1 and pho_id= ".$row['pho_id'];
  	$stmt3 = $db->prepare($query3);

	$stmt3->execute();
	$result3 = $stmt3->fetchAll();
	foreach($result3 as $row3) {
		$hourrate=$row3['price'];
		//echo $hourrate;
	}
	
	
}


$stmt = $db->prepare("SELECT app_id, status, start, strftime('%Y', start) as startY, strftime('%m', start) as startM, strftime('%d', start) as startD, end FROM appointments WHERE pho_id= :pho_id");

$stmt->bindParam(':pho_id', $pho_id);

$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {

$pieces = explode("/", $row['start']);
$Sday = $pieces[0]; // piece1
$Smonth = $pieces[1]; // piece2
$temp = $pieces[2]; // piece2
$pieces2 = explode(" ", $temp);
$Syear = $pieces2[0];
$temp2 = $pieces2[1];
$pieces3 = explode(":", $temp2);
$Shour = $pieces3[0];
$Smin = $pieces3[1];
$Sampm  = $pieces2[2];

}

?>  
<html>
<head>
<meta charset="UTF-8" />
<title>index</title>
<!-- Range slider-->
<?php include 'price-range-js.php' ?>
<!-- Range slider-->  
  	<!--<script>
  		$(function(){
  			$("#searchBarContainer").load("searchbar.html");
  		});
  	</script>-->
	<link rel="stylesheet" href="css/style.css?v=1">
	
<!-- scheduler-->
     <link rel="stylesheet" href="js/jqxscheduler/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
<!--	<script type="text/javascript" src="../../scripts/jquery-1.12.4.min.js"></script>-->
    <script type="text/javascript" src="js/jqxscheduler/jqxcore.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxbuttons.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxscrollbar.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxdata.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxdate.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxscheduler.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxscheduler.api.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxmenu.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxcalendar.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxtooltip.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxwindow.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxcheckbox.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxlistbox.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxnumberinput.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxradiobutton.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/jqxinput.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/globalization/globalize.js"></script>
    <script type="text/javascript" src="js/jqxscheduler/globalization/globalize.culture.de-DE.js"></script>
<script type="text/javascript" src="js/jqxscheduler/demos.js"></script>

<script type="text/javascript">
        $(document).ready(function () {
            var appointments = new Array();
<?php
$setAppointmentProperty = "";

$stmt = $db->prepare("SELECT app_id, status, start, strftime('%Y', start) as startY, strftime('%m', start) as startM, strftime('%d', start) as startD, end FROM appointments WHERE pho_id= :pho_id");

$stmt->bindParam(':pho_id', $pho_id);

$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {

	$pieces = explode("/", $row['start']);
	$Sday = intval($pieces[0]); // piece1
	$Smonth = intval($pieces[1])-1; // piece2
	$temp = $pieces[2]; // piece2
	$pieces2 = explode(" ", $temp);
	$Syear = intval($pieces2[0]);
	$temp2 = $pieces2[1];
	$pieces3 = explode(":", $temp2);
	$Shour = intval($pieces3[0]);
	$Smin = intval($pieces3[1]);
	$Sampm  = $pieces2[2];
	if ($Sampm == "PM"){
		$Shour = $Shour+12;
	}

	$pieces = explode("/", $row['end']);
	$Eday = intval($pieces[0]); // piece1
	$Emonth = intval($pieces[1])-1; // piece2
	$temp = $pieces[2]; // piece2
	$pieces2 = explode(" ", $temp);
	$Eyear = intval($pieces2[0]);
	$temp2 = $pieces2[1];
	$pieces3 = explode(":", $temp2);
	$Ehour = intval($pieces3[0]);
	$Emin = intval($pieces3[1]);
	$Eampm  = $pieces2[2];
	if ($Eampm == "PM"){
		$Ehour = $Ehour+12;
	}

	echo "            var appointment".$row['app_id']." = {\n";           
    echo "                id: 'id".$row['app_id']."',\n";
    echo "                description: '',\n";
    echo "                location: '',\n";
    echo "                subject: '".$row['status']."',\n";
    echo "                calendar: '".$row['status']."',\n";
    echo "                start: new Date(".$Syear.", ".$Smonth.", ".$Sday.", ".$Shour.", ".$Smin.", 0),\n";
    echo "                end: new Date(".$Eyear.", ".$Emonth.", ".$Eday.", ".$Ehour.", ".$Emin.", 0),\n";
    echo "            }\n";
	echo "            appointments.push(appointment".$row['app_id'].");\n\n";
	
	$setAppointmentProperty .="$('#scheduler').jqxScheduler('ensureAppointmentVisible', 'id".$row['app_id']."');\n";                    
    $setAppointmentProperty .="$('#scheduler').jqxScheduler('setAppointmentProperty', 'id".$row['app_id']."', 'resizable', false);\n"; 
    $setAppointmentProperty .="$('#scheduler').jqxScheduler('setAppointmentProperty', 'id".$row['app_id']."', 'draggable', false);\n"; 
	$setAppointmentProperty .="$('#scheduler').jqxScheduler('setAppointmentProperty', 'id".$row['app_id']."', 'readOnly', true); \n"; 
}

?>
/*
            var appointment1 = {            
                id: "id1",
                description: "George brings projector for presentations.",
                location: "",
                subject: "Quarterly Project Review Meeting",
                calendar: "Reserved",
                start: new Date(2017, 0, 23, 9, 0, 0),
                end: new Date(2017, 0, 23, 16, 0, 0)
            }

            var appointment2 = {
                id: "id2",
                description: "",
                location: "",
                subject: "IT Group Mtg.",
                calendar: "Reserved",
                start: new Date(2017, 12, 24, 10, 0, 0),
                end: new Date(2017, 12, 24, 15, 0, 0)
            }

            var appointment3 = {
                id: "id3",
                description: "",
                location: "",
                subject: "Course Social Media",
                calendar: "Reserved",
                start: new Date(2017, 12, 27, 11, 0, 0),
                end: new Date(2017, 12, 27, 13, 0, 0)
            }

            var appointment4 = {
                id: "id4",
                description: "",
                location: "",
                subject: "New Projects Planning",
                calendar: "Reserved",
                start: new Date(2017, 12, 23, 16, 0, 0),
                end: new Date(2017, 12, 23, 18, 0, 0)
            }

            var appointment5 = {
                id: "id5",
                description: "",
                location: "",
                subject: "Interview with James",
                calendar: "Reserved",
                start: new Date(2017, 12, 25, 15, 0, 0),
                end: new Date(2017, 12, 25, 17, 0, 0)
            }

            var appointment6 = {
                id: "id6",
                description: "",
                location: "",
                subject: "Interview with Nancy",
                calendar: "Not Avaliable",
                start: new Date(2017, 12, 26, 14, 0, 0),
                end: new Date(2017, 12, 26, 16, 0, 0)
            }*/
            //appointments.push(appointment1);
            /*appointments.push(appointment2);
            appointments.push(appointment3);
            appointments.push(appointment4);
            appointments.push(appointment5);
            appointments.push(appointment6);
            */

            // prepare the data
            var source =
            {
                dataType: "array",
                dataFields: [
                    { name: 'id', type: 'string' },
                    { name: 'description', type: 'string' },
                    { name: 'location', type: 'string' },
                    { name: 'subject', type: 'string' },
                    { name: 'calendar', type: 'string' },
                    { name: 'start', type: 'date' },
                    { name: 'end', type: 'date' }
                ],
                id: 'id',
                localData: appointments
            };
            var adapter = new $.jqx.dataAdapter(source);
            $("#scheduler").jqxScheduler({
<?php
date_default_timezone_set("Asia/Hong_Kong");
$Y = date("Y"); 
$M = date("m"); 
$D = date("d"); 
?>            
                date: new $.jqx.date(<?php echo $Y; ?>, <?php echo $M; ?>, <?php echo $D; ?> ),
                
                //width: getWidth('Scheduler'),
                width: 1000,
                height: 600,
                source: adapter,
                view: 'weekView',
                showLegend: true,
                // called when the dialog is craeted.
        editDialogCreate: function (dialog, fields, editAppointment) {
        	// hide repeat option
            fields.repeatContainer.hide();
            // hide status option
            fields.statusContainer.hide();
            // hide timeZone option
            fields.timeZoneContainer.hide();
            // hide color option
            fields.colorContainer.hide();
            fields.locationContainer.hide();
            fields.subjectContainer.hide();            
            fields.resourceContainer.hide();                        
            fields.descriptionContainer.hide();    

			//disable original save button            
            fields.saveButton.hide();     
            
            // add custom Reserve button
            reserveButton = $("<button style='margin-left: 5px; float:right;'>Reserve</button>");
            fields.buttons.append(reserveButton);
            reserveButton.jqxButton({ theme: this.theme });   
            reserveButton.click(function(){
            var isConfirm = confirm("Confirm to reserve this timeslot?("+fields.from.val()+" - "+fields.to.val()+"):", "Event");
                   
                    if (isConfirm !=true){;}else{
                    	//alert("submit")
                    	$("#from").val(fields.from.val());
                    	$("#to").val(fields.to.val());     
                    	$("#bookingForm").submit();               	
                    }
            })
            
            
        },
                ready: function () {
                    $("#scheduler").jqxScheduler('ensureAppointmentVisible', 'id1');
                    
                    $("#scheduler").jqxScheduler('setAppointmentProperty', 'id1', 'resizable', false);
                    $("#scheduler").jqxScheduler('setAppointmentProperty', 'id1', 'draggable', false);
                    $("#scheduler").jqxScheduler('setAppointmentProperty', 'id1', 'readOnly', true); 
                    <?php echo $setAppointmentProperty; ?>                   
                },
                resources:
                {
                    colorScheme: "scheme05",
                    dataField: "calendar",
                    source:  new $.jqx.dataAdapter(source)
                },
                appointmentDataFields:
                {
                    from: "start",
                    to: "end",
                    id: "id",
                    description: "description",
                    location: "location",
                    subject: "subject",
                    resourceId: "calendar"
                },
                views:
                [
                    'dayView',
                    'weekView',
                    'monthView'
                ]
            });
        });
    </script>
<!-- scheduler-->
    
</head>
<body class='default'>

	<div id="container">
		<div id="mainContainer">
			<div id="header">
			<?php include 'header.php' ?>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<!-- Search Bar -->
			<div id="searchBarContainer" style="display:none">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
<h2><?php echo $pho_name; ?></h2>
Hourly rate: $<?php echo $hourrate; ?><br /><br />
<div id="scheduler"></div>
<div class="clear"></div>																					
			</div>
			<div id="footer">
				PhotoPeoples Copywrite 2017
				<a href="#" style="float:right">Help</a>
			</div>
		<div>
		<!-- End of mainContainer -->
	</div>
	<!-- End of container -->
	<form action="booking_detail.php" id="bookingForm" method="post">
		<input type="hidden" name="from" id="from">
		<input type="hidden" name="to" id="to">
		<input type="hidden" name="cust_id" id="cust_id" value="<?php echo $_SESSION['cust_id']; ?>">			
		<input type="hidden" name="pho_id" id="pho_id" value="<?php echo $pho_id; ?>">					
		
	</form>
</body>
</html>