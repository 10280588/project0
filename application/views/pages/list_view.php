<!-- begin of page -->
<div data-role="page"  class="ui-body-a">
    
    <!-- begin of header -->
	<div data-role="header" data-theme="a">
	<a href="javascript:history.back()"  data-role="button"  data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1><?php echo $pageTitle?></h1>
	<a href="#popupPanel" data-rel="popup" data-transition="slide" data-position-to="window" data-role="button" data-icon="gear" data-iconpos="notext">Options</a>
    <?php if(($pageTitle !== 'Search Results') && ($pageTitle !== 'My Courses') && ($pageTitle !== 'Recently Viewed')): ?>
    <div data-role="navbar"  data-theme="a">
		<ul>
			<li><a href="<?php echo site_url('courses')?>">All</a></li>
			<li><a href="<?php echo site_url('courses/departments')?>">By Dep.</a></li>
			<li><a href="<?php echo site_url('courses/gened_areas')?>">By Gen. Ed.</a></li>
		</ul>
	</div><!-- /navbar -->
	<?php endif ?>
    
    </div>
    <!-- end of header -->

    <!-- begin of content -->
    <div data-role="content">
	<ul data-role="listview"  data-autodividers="true" data-filter="true">
		<?php $i = 0;?>
		<?php foreach ($results as $result): ?>
            <?php 
            if($pageTitle == 'Departments')
            {
        	    $functionSegment = 'department';
                $argumentSegment = $result['dept_number'];
                $objectName = $result['short_name'];
            }
            elseif($pageTitle == 'Gen Ed Areas')
            {
        	    $data['functionSegment'] = 'gened_area';
                $argumentSegment = $result['req_number'];
                $objectName = $result['name'];
            }
            else
            {
                $functionSegment = 'course';
                $argumentSegment = $result['course_unique'];
                $objectName = $result['title'];
            }
            ?>
            
                 <?php $segments = array('courses',$functionSegment,$argumentSegment); ?>
                <li><a href="<?php echo site_url($segments) ?>" >  <?php echo $objectName ?></a></li>
              
   
        <?php endforeach ?>
	    </ul>
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

