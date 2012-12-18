<div data-role="page" id="home" data-theme="a">
    <div data-role="content" class="ui-content" role="main">
        <div  id="picture">
            <div id="pictureFrame">
                <img src="http://www.fas.harvard.edu/home/sites/all/themes/fas/images/harvard_fas_logo.jpg" width="250" alt="" />
            </div>
        </div>
        <form action="<?php echo site_url('courses/search') ?>" method="get">
            <input type="text" data-type="search" name="searchHome" id="searchHome" value="" class="ui-input-text ui-body-a">
            <input type="submit" data-mini="true" value="Search for course" />
            <input type="hidden" name="title_check" value="on" >
            <input type="hidden" name="day" value="all" >
            <input type="hidden" name="begin_time" value="all" >
            <input type="hidden" name="end_time" value="all" >
            <input type="hidden" name="department" value="all" >
            <input type="hidden" name="gened" value="all" >
        </form>
        <ul data-role="listview" data-inset="true" >
            <li  data-role="list-divider"  ></li>
	        <li><a href="<?php echo site_url('courses/advanced_search') ?>" >Advanced Search</a></li>
	        <li><a href="<?php echo site_url('courses')?>">All Courses</a></li>
	        <li><a href="<?php echo site_url('users/my_courses')?>">My Courses</a></li>
	        <li><a href="<?php echo site_url('users/last_ten')?> ">Recently Viewed</a></li>
	        <li><a href="<?php echo site_url('contact')?> ">Contact Info</a></li>
	        <li><a href="<?php echo site_url('users/logout')?>">Logout</a></li>
        </ul>
    </div><!--- end of content --> 
</div><!--- end of page -->

