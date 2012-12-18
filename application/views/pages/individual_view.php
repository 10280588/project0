<?php 
reset($courses);
$course = current($courses);
reset($schedule);
$sched = current($schedule);
?>

<!-- begin of page -->
<div data-role="page" class="individual" data-theme="a" >
    
    <!-- begin of header -->
	<div data-role="header" data-position="inline">
	    <a href="javascript:history.back()" data-role="button"  data-icon="arrow-l" data-iconpos="notext">Back</a>
	    <h1>Course Info</h1>
	    
	    <?php if ($enrolled === "yes"): ?>
	    	     <a  href="<?php echo site_url(array('users','remove_course',$course['course_unique'])) ?>" data-icon="minus" class="ui-btn-right">Del</a>
	    <?php else: ?>
	             <a  href="<?php echo site_url(array('users','add_course',$course['course_unique'])) ?>" data-icon="plus" class="ui-btn-right">Add</a>
	    <?php endif ?>
	  
	</div>
    <!-- end of header -->
    
    <!-- begin of content -->
    <div data-role="content">
        <h2><?php echo $course['title'];?></h2>
        
        <!-- begin of description -->
        <div data-role="collapsible" data-inset="false">
            <h3>Description</h3>
            <?php if (empty($course['description'])): ?>
                <p>No description available</p>
            <?php else: ?>
            <p id="description" ><?php echo $course['description'];?></p>
            <?php endif?>
        </div>
        <!-- end of description -->
        
        <!--begin of additional information -->
        <div data-role="collapsible" class="addInfo" data-inset="false">
            <h3>Additional Information</h3>
            <p>
                <span class="bold red block">Department: </span> <?php echo ( empty($course['short_name']) ? 'No info' :  $course['short_name'] ); ?>
            </p>
            <p>
                <span class="bold red block">Catalog number:</span> <?php echo ( empty($course['cat_num']) ? 'No info' :  $course['cat_num'] ); ?>
            </p>
            <p>
                <span class="bold red block">When:</span> <?php echo  $sched['name'] .' '. $course['year'] ;?>
            </p>
            <p></p>
                <span class="bold red block">Instructors:</span>
                <?php $currentFacl = current($faculty); ?>
                <?php if ($currentFacl['middle_name'] == 'faculty'): ?>
                    <p>No faculty information available</p>
                <?php else: ?>
                <table>
                    <tr>
                        <td  class="title">Name</td>
                        <td  class="title center quarter">Role</td>
                        <td  class="title center quarter">Term</td>
                    </tr>
                    
                    <?php foreach($faculty as $facl): ?>
                    <tr>
                        <td><?php echo $facl['prefix'] .' '. $facl['first_name'] .' '. $facl['middle_name'] .' '. $facl['last_name'] .' '. $facl['suffix']; ?></td>
                        <td class="center quarter"><?php echo $facl['role'];?></td>
                        <td class="center quarter"><?php echo $facl['term_number'];?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
                <?php endif ?>
               
            
            <p></p>
                <span class="bold red block">Locations:</span>
                <?php if (empty($locations)): ?>
                    <p>No location information available</p>
                <?php else: ?>
                    <table>
                        
                        <tr>
                            <td  class="title">Building</td>
                            <td  class="title center quarter">Room</td>
                            <td  class="title center quarter">Term</td>
                        </tr>
                        
                        <?php foreach($locations as $location): ?>
                        <tr>
                            <td><?php echo $location['building']; ?></td>
                            <td class="center quarter"><?php echo $location['room']; ?></td>
                            <td class="center quarter"><?php echo $location['term_number']; ?></td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                <?php endif ?>
           
        </div>
        <!-- end of additional information -->
        
        <!-- begin of notes -->
        <div data-role="collapsible" data-inset="false">
            <h3>Notes</h3>
            <?php if (empty($course['notes'])): ?>
                    <p>No notes available</p>
                <?php else: ?>
            <p><?php echo $course['notes'];?></p>
            <?php endif ?>
        </div>
        <!-- end of notes -->
    
         
	    <?php if ($enrolled === "yes"): ?>
	    	     <a  href="<?php echo site_url(array('users','remove_course',$course['course_unique'])) ?>" data-role="button">Remove from basket</a>
	    <?php else: ?>
	             <a  href="<?php echo site_url(array('users','add_course',$course['course_unique'])) ?>" data-role="button" >Add to basket</a>
	    <?php endif ?>
        
    </div>
    <!-- end of content -->
    
    <!-- begin of red schedule -->
    <div id="redArea" >
        <div id="content" data-role="content">
            <?php if (empty($schedule)): ?>
                <p class="white">No schedule information available</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Type</th>
                        <th>Day</th>
                        <th class="center">Time</th>
                        <th class="center">Optional</th>
                    </tr>
                    <?php foreach($schedule as $schedul): ?>
                        <tr>
                            <td>Lecture</td>
                            <td><?php echo $schedul['short_name']?></td>
                            <td class="center">
                               <?php echo $schedul['begin_time']?>-<?php echo $schedul['end_time']?>
                            </td>
                            <td class="center"><?php echo $schedul['optional']?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
    </div>
    <!-- end of red schedule -->
    
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
<!-- end of page -->
