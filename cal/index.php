<!DOCTYPE html>
<html>
<head>
    <title>HTML5 Event Calendar</title>
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />    

        <link type="text/css" rel="stylesheet" href="themes/calendar_g.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_white.css" />    

	<!-- helper libraries -->
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	
</head>
<body>
<form id="bookingForm" action="booking.php" method="post">

        <div class="shadow"></div>
        <div class="hideSkipLink">
        </div>
        <div class="main">
            <h2>Please highligh timeslot to make reservstion</h2>
            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
            <div style="margin-left: 160px;">
                
                <div class="space">
                    Theme: <select id="theme">
                        <option value="calendar_default">Default</option>
                        <option value="calendar_white">White</option>                        
                        <option value="calendar_g">Google-Like</option>                        
                        <option value="calendar_green">Green</option>                        
                        <option value="calendar_traditional">Traditional</option>                        
                        <option value="calendar_transparent">Transparent</option>                        
                    </select>
                </div>
                
                <div id="dp"></div>
            </div>

            <script type="text/javascript">              
                var nav = new DayPilot.Navigator("nav");
                nav.showMonths = 3;
                nav.skipMonths = 3;
                nav.selectMode = "week";
                nav.onTimeRangeSelected = function(args) {
                    dp.startDate = args.day;
                    dp.update();
                    loadEvents();
                };
                nav.init();
  
                var dp = new DayPilot.Calendar("dp");
                dp.viewType = "Week";
dp.onEventMoved = 'Disabled';
/*
                dp.onEventMoved = function (args) {
                    $.post("backend_move.php", 
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            }, 
                            function() {
                                console.log("Moved.");
                            });
                };
*/
dp.onEventResized = 'Disabled';
/*
                dp.onEventResized = function (args) {
                    $.post("backend_resize.php", 
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            }, 
                            function() {
                                console.log("Resized.");
                            });
                };
*/
                // event creating
                dp.onTimeRangeSelected = function (args) {
                    //var name = prompt("New event name:", "Event");
                    //var name = prompt("Confirm to reserve this timeslot?("+args.start.toString()+" - "+args.end.toString()+"):", "Event");
                    var isConfirm = confirm("Confirm to reserve this timeslot?("+args.start.toString()+" - "+args.end.toString()+"):", "Event");
                    if (isConfirm !=true){dp.clearSelection();return;}
                    //check timeslot available
                    var chk_ava = true;
                    $.post("backend_check_timeslot_available.php", 
                    	{
                    		start: args.start.toString(),
                       		end: args.end.toString(),
                       		pho_id: <?php echo $_GET['pho_id'];?>
                        },
                        function(data) {
                        	if (data=="NO"){
                        		alert("Timeslot reserved already. Please choose another timeslot");
                        		dp.clearSelection();
                        	}else{
                        		dp.clearSelection();
                    			//if (!name) return;
            			        var e = new DayPilot.Event({
            			        	start: args.start,
									end: args.end,
									id: DayPilot.guid(),
									resource: args.resource,
									moveDisabled: true,
                        			text: name
                    			});
                    			dp.events.add(e);

                    			$.post("backend_create.php", 
                            		{
                                		start: args.start.toString(),
                                		end: args.end.toString(),
                                		//name: name
                                		name: "Temp Hold",
                                		pho_id: <?php echo $_GET['pho_id'];?>
                  			          }, 
                            		function() {
                                		console.log("Created.");
                                		
                            		});
                            	

                            	$('#start').val(args.start.toString());	
                            	$('#end').val(args.end.toString());	
                            	                           	

                            	$('#bookingForm').submit();	
                        	
                        	}
                        	
                    	});
                    //check timeslot available END
                    
                    /*dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: name
                    });
                    dp.events.add(e);

                    $.post("backend_create.php", 
                            {
                                start: args.start.toString(),
                                end: args.end.toString(),
                                name: name
                            }, 
                            function() {
                                console.log("Created.");
                            });*/

                };

                dp.onEventClick = function(args) {
                    //alert("clicked: " + args.e.id());
                    
                    /*var e = new DayPilot.Event({
            			        	start: args.start,
									end: args.end,
									id: DayPilot.guid(),
									resource: args.resource,
                        			text: name*/
                     alert (args.e.start());   			
                        			
                };


                dp.init();
				
				//dp.theme = 'calendar_white';
			
                loadEvents();

                function loadEvents() {
                    var start = dp.visibleStart();
                    var end = dp.visibleEnd();

                    $.post("backend_events.php", 
                    {
                        start: start.toString(),
                        end: end.toString(),
                        pho_id: <?php echo $_GET['pho_id'];?>
                    }, 
                    function(data) {
                    alert(data);
                        console.log(data);
                        dp.events.list = data; 
                                                  
                        dp.update();
                    });
                }

            </script>
            
            <script type="text/javascript">
            $(document).ready(function() {
                $("#theme").change(function(e) {
                    dp.theme = this.value;
                    dp.update();
                });
            });  
            </script>

        </div>
        <div class="clear">
        </div>
		<input type="hidden" name="start" id="start" >
		<input type="hidden" name="end" id="end">

 </form>       
</body>
</html>

