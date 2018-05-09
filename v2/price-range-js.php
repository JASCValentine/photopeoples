<?php
$amountvalueLow = isset($_POST['amountvalueLow']) ? $_POST['amountvalueLow'] : '0';
$amountvalueHigh = isset($_POST['amountvalueHigh']) ? $_POST['amountvalueHigh'] : '500';
$values = "$amountvalueLow, $amountvalueHigh";
?>
<!-- Range slider-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">-->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {  
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 5000,
      values: [ <?php echo htmlspecialchars($values);?> ],
      swipeThreshold: 500,
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
      
  } );
  </script> 
  <style>
label[for=amount]
{
    font-size:12px;
    color:#757575;
}
#amount text{
    font-size:10px;
}
  </style>
<!-- Range slider-->