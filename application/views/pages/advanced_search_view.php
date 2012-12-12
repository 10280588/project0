<div data-role="page" id="advancedSearch" data-theme="a">
    
    <!-- begin of header -->
	<div data-role="header" data-position="inline">
	    <a href="<?php echo site_url('home')?>" data-role="button" data-icon="arrow-l" data-iconpos="notext">Back</a>
	    <h1>Advanced Search</h1>
	</div>
    <!-- end of header -->
    
    <!-- begin of content -->
    <div data-role="content" class="ui-content" role="main">
        <form action="<?php echo  site_url('courses/search');?>" method="get">
            <input type="text" data-type="search" name="searchHome" id="search-basic" value="" class="ui-input-text ui-body-a">
            
            <div  data-role="fieldcontain">
			 	<fieldset data-role="controlgroup">
					<legend>Search in</legend>
					<input type="checkbox" name="title_check" id="title_check" class="custom" />
					<label for="title_check">Title</label>

					<input type="checkbox" name="description_check" id="description_check" class="custom" />
					<label for="description_check">Department</label>
					
					<input type="checkbox" name="faculty_check" id="faculty_check" class="custom" />
					<label for="faculty_check">Faculty</label>

				
			    </fieldset>
			</div>
             
            <div data-role="fieldcontain">
	            <select name="department" id="department">
		            <option value="FALSE">All Departments</option>
		            
		            <?php foreach ($departments as $department):?>
		            <option value="<?php $department['dept_number']?>"> <?php echo $department['short_name']?></option>
	                <?php endforeach ?>
	                
	            </select>
            </div>
            <div data-role="fieldcontain">
	            <select name="gened" id="gened">
		            <option value="FALSE">All Gen Ed areas</option>
		            
		            <?php foreach ($geneds as $gened):?>
		            <option value="<?php $gened['req_number']?>"> <?php echo $gened['name']?></option>
	                <?php endforeach ?>
	                
		        </select>
            </div>
            <div id="time" data-role="fieldcontain">
                <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal">
                    <label for="day">Day</label>
                    <select name="day"  id="day">
                        <option value="FALSE">day</option>
                        <option value="1">Mon</option>
                        <option value="2">Tue</option>
                        <option value="3">Wed</option>
                        <option value="4">Thu</option>
                        <option value="5">Fri</option>
                        <option value="6">Sat</option>
                        <option value="7">Sun</option>
                    </select>
                    <label for="begin_time">start</label>
                    <select name="begin_time"  id="begin_time">
                        <option value="FALSE">start</option>
                        
                        <?php $h=0; while ($h <= 23): ?>
		               
		                <?php $q=0; while ($q <= 3):?>
		                <option value="<?php echo $h.($q*15)?>"><?php printf("%02d", $h); echo ':'; printf("%02d", ($q*15))?></option>
	                    <?php $q = $q+1; ?>
	                    <?php endwhile ?>
	                    
	                    <?php $h = $h+1; ?>
	                    <?php endwhile ?>
                    
                    </select>
                    <label for="end_time">Year</label>
                    <select name="end_time"  id="end_time">
                        <option value="FALSE">end</option>
                        <?php $h=0; while ($h <= 23): ?>
		               
		                <?php $q=0; while ($q <= 3):?>
		                <option value="<?php echo $h.($q*15)?>"><?php printf("%02d", $h); echo ':'; printf("%02d", ($q*15))?></option>
	                    <?php $q = $q+1; ?>
	                    <?php endwhile ?>
	                    
	                    <?php $h = $h+1; ?>
	                    <?php endwhile ?>
                    </select>
                </fieldset>
            </div>
            <input type="submit"  value="Submit Button" />
        </form>
    </div><!--- end of content --> 
    
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


</div><!--- end of page -->

