<div data-role="page" data-theme="a">
    <div data-role="content" class="ui-content" role="main">
        <div  id="picture">
        
        </div>
        
        <form action="index.php/courses/searchresult" method="get">
            <input type="text" data-type="searchHome" name="searchHome" id="searchHome" value="" class="ui-input-text ui-body-a">
            <input type="submit" data-mini="true" value="Submit Button" />
        </form>
        <ul data-role="listview" data-inset="true" >
            <li  data-role="list-divider"  ></li>
	        <li><a href="#advancedSearch" data-transition="slide">Advanced Search</a></li>
	        <li><a href="index.php/courses" data-transition="slide">All Courses</a></li>
	        <li><a href="#myCourses"  data-transition="slide">My Courses</a></li>
	        <li><a href="#contactInfo"  data-transition="slide">Contact Info</a></li>
        </ul>
    </div><!--- end of content --> 
</div><!--- end of page -->

