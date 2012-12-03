<!-- Start of second page: #three -->
<div data-role="page" id="three" class="ui-body-a">

	<div data-role="header">
	<a href="index.html" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1>Page Title</h1>
	<a href="#popupBasic" data-rel="popup"  data-role="button" href="foo.html" data-position-to="window" data-icon="gear" data-iconpos="notext">Options</a>
</div>


<div data-role="content">
    <?php foreach($courses as $course): ?>
    <h1><?php echo $course['title'];?></h1>
    <p><?php echo $course['description'];?></p>
    <?php endforeach ?>
</div>


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
