<?php
$keywordValue = isset($_POST['keyword']) ? $_POST['keyword'] : '';
$pho_nameValue = isset($_POST['pho_name']) ? $_POST['pho_name'] : '';
$destinationValue = isset($_POST['destination']) ? $_POST['destination'] : '';
$dateValue = isset($_POST['date']) ? $_POST['date'] : '';
$typeValue = isset($_POST['type']) ? $_POST['type'] : '';
?>
<script>
$( document ).ready(function() {
	$('#buttonSearchBarSearch').click(function(){
	//$('#amountvalue').val($( "#amount" ).val());
	$('#amountvalueLow').val($( "#slider-range" ).slider( "values", 0 ));
	$('#amountvalueHigh').val($( "#slider-range" ).slider( "values", 1 ));
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
	<li><input name="destination" id="destination" placeholder="Destination" value="<?php echo htmlspecialchars($destinationValue) ?>" /></li>
	<li><input name="date" id="date" placeholder="Date" size="10" value="<?php echo htmlspecialchars($dateValue) ?>" /></li>
	<li><select name="type" id="type">
					<option selected disabled>Type</option>
					<option <?php if ($typeValue=="travel"){echo "selected";} ?> value="travel">Travel</option>
					<option <?php if ($typeValue=="wedding"){echo "selected";} ?> value="wedding">Wedding</option>
					<option <?php if ($typeValue=="others"){echo "selected";} ?> value="others">Others</option>
				</select>
		</li>		
	<li><input name="pho_name" id="pho_name" placeholder="Photographer's name" value="<?php echo htmlspecialchars($pho_nameValue) ?>" /></li>
	<li><input name="keyword" id="keyword" placeholder="Keyword" value="<?php echo htmlspecialchars($keywordValue) ?>" /></li>

  	<li><label for="amount">Price range:</label>
  <input type="text" id="amount" size="14" readonly style="border:0; color:#757575; font-weight:bold;">

 <div style="width:100px;display:inline:;padding-top:5px;float:right;margin-right:50px;">
	<div id="slider-range" ></div>
	<input type="hidden" name="amountvalueLow" id="amountvalueLow">
	<input type="hidden" name="amountvalueHigh" id="amountvalueHigh">	
</div>
</li>
																
	<li>			<button id="buttonSearchBarSearch" name="buttonSearchBarSearch">Search</button></li>
</ul>
</form>
<div class="clear"></div>