<style>
	#searchBarContainer ul {
		list-style-type: none;
    	margin: 0;
    	padding: 0;
    }
	#searchBarContainer li {float:left;}
</style>
<ul>
	<li><input placeholder="Destination" /></li>
	<li><input placeholder="Date" size="10" /></li>
	<li><select name="Type">
					<option selected disabled>Type</option>
					<option value="travel">Travel</option>
					<option value="wedding">Wedding</option>
					<option value="others">Others</option>
				</select>
		</li>		
	<li><input placeholder="Photographer's name" /></li>
	<li><input placeholder="Keyword" /></li>

  	<li><label for="amount">Price range:</label>
  <input type="text" id="amount" size="14" readonly style="border:0; color:#f6931f; font-weight:bold;">

 <div style="width:100px;display:inline:;padding-top:5px;float:right;margin-right:50px;">
	<div id="slider-range" ></div>
</div>
</li>
																
	<li>			<button>Search</button></li>
</ul>
<div class="clear"></div>