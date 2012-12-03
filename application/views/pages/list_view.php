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
		<?php $i = 0; ?>
				<?php foreach ($courses as $course): ?>
        <?php if ($i < 500)  :?>
    <li><a href="courses/course/<?php echo $course['course_unique']; ?> "><?php echo $course['title'] ?></a></li>
    
    <?php  $i++ ?>
    <?php endif ?>
   
<?php endforeach ?>
			</ul>
		
	</div><!-- /content -->
	
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
			<li><a href="/"  data-icon="home">Home</a></li>
			<li><a href="#"  data-icon="search">Search</a></li>
			<li><a href="#"  data-icon="alert">Basket</a></li>
			<li><a href="#"  data-icon="info">Info</a></li>
		</ul>
	</div><!-- /navbar -->
	</div><!-- /footer -->
</div><!-- /page three -->
