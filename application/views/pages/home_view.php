<div data-role="page" id="home" data-theme="a">
    <div data-role="content" class="ui-content" role="main">
        <div  id="picture">
            <div id="pictureFrame">
                <img src="http://www.fas.harvard.edu/home/sites/all/themes/fas/images/harvard_fas_logo.jpg" width="260" alt="" />
            </div>
        </div>
        <form action="index.php/courses/searchresult" method="get">
            <input type="text" data-type="searchHome" name="searchHome" id="searchHome" value="" class="ui-input-text ui-body-a">
            <input type="submit" data-mini="true" value="Submit Button" />
        </form>
        <ul data-role="listview" data-inset="true" >
            <li  data-role="list-divider"  ></li>
	        <li><a href="<?php echo site_url('courses/advanced_search') ?>" data-transition="slide">Advanced Search</a></li>
	        <li><a href="<?php echo site_url('courses') ?>" data-transition="slide">All Courses</a></li>
	        <li><a href="<?php echo site_url('users/my_courses') ?>"  data-transition="slide">My Courses</a></li>
	        <li><a href="<?php echo site_url('contact') ?>"  data-transition="slide">Contact Info</a></li>
	        <li><a href="<?php echo site_url('users/logout') ?>"  data-transition="slide">Logout</a></li>
        </ul>
    </div><!--- end of content --> 
</div><!--- end of page -->

