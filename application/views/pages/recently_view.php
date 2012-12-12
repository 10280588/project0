<!-- begin of page -->
<div data-role="page"  class="ui-body-a">
    
    <!-- begin of header -->
	<div data-role="header">
	<a href="<?php echo site_url('home')?>"  data-role="button"  data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1>Page Title</h1>
	<a href="#popupPanel" data-rel="popup" data-transition="slide" data-position-to="window" data-role="button" data-icon="gear" data-iconpos="notext">Options</a>
    </div>
    <!-- end of header -->
    
    

    <!-- begin of content -->
    <div data-role="content">
	<ol data-role="listview"  >
		<?php $i = 0; ?>
		
		<?php foreach ($courses as $course): ?>
        
            <?php if ($i < 500)  :?>
                <li><a href="courses/course/<?php echo $course['course_unique']; ?> "><?php echo $course['title'] ?></a></li>
                <?php  $i++ ?>
            <?php endif ?>
   
        <?php endforeach ?>
	    </ol>
	</div>
	<!-- end of content -->
	
	  <!-- begin of footer -->
    <div data-role="footer" data-position="fixed">
	    <div data-role="navbar">
		    <ul>
			    <li><a href="<?php echo site_url('home')?>"  data-icon="home">Home</a></li>
			    <li><a href="<?php echo site_url('courses/advanced_search')?>"  data-icon="search">Search</a></li>
			    <li><a href="<?php echo site_url('users/my_courses')?>"  data-icon="info">My Courses</a></li>
			    <li><a href="<?php echo site_url('users/logout')?>"  data-icon="minus">Logout</a></li>
		    </ul>
	    </div>
    </div>
    <!-- end of footer -->
    
</div>

