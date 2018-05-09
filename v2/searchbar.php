<?php
$searchKeyword = $_POST['keyword'];
$keywordValue ="";
if ($searchKeyword!=""){
	$keywordValue="value='".$searchKeyword."'";
}

$searchPho_name = $_POST['pho_name'];
$pho_nameValue ="";
if ($searchPho_name!=""){
	$pho_nameValue="value='".$searchPho_name."'";
}

$searchDestination = $_POST['destination'];
$destinationValue ="";
if ($searchDestination!=""){
	$destinationValue="value='".$searchDestination."'";
}

$searchDate = $_POST['date'];
$dateValue ="";
if ($searchDate!=""){
	$dateValue="value='".$searchDate."'";
}

$searchType = $_POST['type'];
$typeValue ="";
if ($searchType!=""){
	$typeValue="value='".$searchType."'";
}
?>
<script>
$( document ).ready(function() {
	$('#buttonSearchBarSearch').click(function(){
	//$('#amountvalue').val($( "#amount" ).val());
	$('#amountvalueLow').val($( "#slider-range" ).slider( "values", 0 ));
	$('#amountvalueHight').val($( "#slider-range" ).slider( "values", 1 ));
	$('#searchbarForm').submit();
	});
});
</script>
<style>
	#searchBarContainer ul {
		list-style-type: none;
    	margin: 0;
    	padding: 0;
    }
	#searchBarContainer li {float:left;}
</style>
<form action="search.php" method="post" id="searchbarForm">
<ul>
	<li><input name="destination" id="destination" placeholder="Destination" <?php echo $destinationValue ?> /></li>
	<li><input name="date" id="date" placeholder="Date" size="10" <?php echo $dateValue ?> /></li>
	<li><select name="Type" id="type">
					<option selected disabled>Type</option>
					<option <?php if ($typeValue=="travel"){echo "selected";} ?> value="travel">Travel</option>
					<option <?php if ($typeValue=="wedding"){echo "selected";} ?>value="wedding">Wedding</option>
					<option <?php if ($typeValue=="others"){echo "selected";} ?>value="others">Others</option>
				</select>
		</li>		
	<li><input name="pho_name" id="pho_name" placeholder="Photographer's name" <?php echo $pho_nameValue ?> /></li>
	<li><input name="keyword" id="keyword" placeholder="Keyword" <?php echo $keywordValue ?> /></li>

  	<li><label for="amount">Price range:</label>
  <input type="text" id="amount" size="14" readonly style="border:0; color:#757575; font-weight:bold;">

 <div style="width:100px;display:inline:;padding-top:5px;float:right;margin-right:50px;">
	<div id="slider-range" ></div>
	<input type="hidden" name="amountvalueLow" id="amountvalueLow">
	<input type="hidden" name="amountvalueHight" id="amountvalueHight">	
</div>
</li>
																
	<li>			<button id="buttonSearchBarSearch" name="buttonSearchBarSearch">Search</button></li>
</ul>
</form>
<div class="clear"></div>