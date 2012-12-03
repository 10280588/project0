<div data-role="page" id="one" data-theme="a">
<div data-role="content" class="ui-content" role="main">
<div  id="picture">
</div>
<input type="text" data-type="search" name="search" id="search-basic" value="" class="ui-input-text ui-body-a">
<input type="submit" data-mini="true" value="Submit Button" />


		
<ul data-role="listview" data-inset="true" >
    <li  data-role="list-divider"  ></li>
	<li><a href="#two" data-transition="slide">Addvanced Search</a></li>
	<li><a href="#three" data-transition="slide">All Courses</a></li>
	<li><a href="#four"  data-transition="slide">My Courses</a></li>
	<li><a href="#five"  data-transition="slide">Contact Info</a></li>
	
</ul>

</div>
</div>


<!-- Start of second page: #two -->
<div data-role="page"  id="two">

	<div data-role="header">
		<h1>Two</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Two</h2>
		
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page two -->

<!-- Start of second page: #three -->
<div data-role="page" id="three" class="ui-body-a">

	<div data-role="header">
	<a href="index.html" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1>Page Title</h1>
	<a href="#popupBasic" data-rel="popup"  data-role="button" href="foo.html" data-position-to="window" data-icon="gear" data-iconpos="notext">Options</a>
</div>


<div data-role="popup" id="popupBasic">
<form action="form.php" method="post"> ... 
	<p>This is a completely basic popup, no options set.<p>
	<fieldset data-role="controlgroup" data-mini="true">
    	<input type="radio" name="radio-mini" id="radio-mini-1" value="choice-1" checked="checked" />
    	<label for="radio-mini-1">Credit</label>

	<input type="radio" name="radio-mini" id="radio-mini-2" value="choice-2"  />
    	<label for="radio-mini-2">Debit</label>
    	
    	<input type="radio" name="radio-mini" id="radio-mini-3" value="choice-3"  />
    	<label for="radio-mini-3">Cash</label>
</fieldset>
</form>
</div>



	<div data-role="content">
	    	
		<ul data-role="listview"  data-filter='true'>
				<li data-role="list-divider">A</li>
				<li><a href="index.html">Adam Kinkaid</a></li>
				<li><a href="index.html">Alex Wickerham</a></li>
				<li><a href="index.html">Avery Johnson</a></li>
				<li data-role="list-divider">B</li>
				<li><a href="index.html">Bob Cabot</a></li>
				<li data-role="list-divider">C</li>
				<li><a href="index.html">Caleb Booth</a></li>
				<li><a href="index.html">Christopher Adams</a></li>
				<li><a href="index.html">Culver James</a></li>
				<li data-role="list-divider">D</li>
				<li><a href="index.html">David Walsh</a></li>
				<li><a href="index.html">Drake Alfred</a></li>
				<li data-role="list-divider">E</li>
				<li><a href="index.html">Elizabeth Bacon</a></li>
				<li><a href="index.html">Emery Parker</a></li>
				<li><a href="index.html">Enid Voldon</a></li>
				<li data-role="list-divider">F</li>
				<li><a href="index.html">Francis Wall</a></li>
				<li data-role="list-divider">G</li>
				<li><a href="index.html">Graham Smith</a></li>
				<li><a href="index.html">Greta Peete</a></li>
				<li data-role="list-divider">H</li>
				<li><a href="index.html">Harvey Walls</a></li>
				<li data-role="list-divider">M</li>
				<li><a href="index.html">Mike Farnsworth</a></li>
				<li><a href="index.html">Murray Vanderbuilt</a></li>
				<li data-role="list-divider">N</li>
				<li><a href="index.html">Nathan Williams</a></li>
				<li data-role="list-divider">P</li>
				<li><a href="index.html">Paul Baker</a></li>
				<li><a href="index.html">Pete Mason</a></li>
				<li data-role="list-divider">R</li>
				<li><a href="index.html">Rod Tarker</a></li>
				<li data-role="list-divider">S</li>
				<li><a href="index.html">Sawyer Wakefield</a></li>
			</ul>
		
	</div><!-- /content -->
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
			<li><a href="#"  data-icon="home">Home</a></li>
			<li><a href="#"  data-icon="search">Search</a></li>
			<li><a href="#"  data-icon="alert">Basket</a></li>
			<li><a href="#"  data-icon="info">Info</a></li>
		</ul>
	</div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page three -->
