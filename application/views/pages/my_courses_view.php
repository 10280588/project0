<!-- begin of page -->
<div data-role="page"  class="ui-body-a">
    
    <!-- begin of header -->
	<div data-role="header">
	<a href="index.html" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1>My courses</h1>
	<a href="#popupPanel" data-rel="popup" data-transition="slide" data-position-to="window" data-role="button" data-icon="gear" data-iconpos="notext">Options</a>
    </div>
    <!-- end of header -->
    
    

    <!-- begin of content -->
    <div data-role="content">
	<ul data-role="listview"  data-filter='true'>
		<?php if(empty($courses)):?>
                <li>Not enrolled in any course</li>
                <?php endif ?>
		<a href="" >
		
		<?php foreach ($courses as $course): ?>
        
               <?php $segments = array('courses','course',$course['course_unique']); ?>
                <li><a href="<?php echo site_url($segments) ?>" >  <?php echo $course['title'] ?></a></li>
        
        <?php endforeach ?>
	    </ul>
	</div>
	<!-- end of content -->

