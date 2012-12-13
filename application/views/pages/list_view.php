<!-- begin of page -->
<div data-role="page"  class="ui-body-a">
    
    <!-- begin of header -->
	<div data-role="header" data-theme="a">
	<a href="<?php echo site_url('home')?>"  data-role="button"  data-icon="arrow-l" data-iconpos="notext">Back</a>
	<h1>Page Title</h1>
	<a href="#popupPanel" data-rel="popup" data-transition="slide" data-position-to="window" data-role="button" data-icon="gear" data-iconpos="notext">Options</a>
    <div data-role="navbar"  data-theme="a">
		<ul>
			<li><a href="#">All</a></li>
			<li><a href="#">By Dep.</a></li>
			<li><a href="#">By Gen. Ed.</a></li>
		</ul>
	</div><!-- /navbar -->
    
    </div>
    <!-- end of header -->
    
    <!-- begin of popup filter -->
    <div data-role="popup" id="popupPanel" data-corners="false" data-theme="none" data-shadow="false" data-tolerance="0,0">

        <div data-role="fieldcontain">
	        <select name="select-choice-2" id="select-choice-2">
		        <option value="AL">Alabama</option>
		        <option value="AK">Alaska</option>
		        <option value="AZ">Arizona</option>
	
	        </select>
        </div>
        
        <div data-role="fieldcontain">
	        <select name="select-choice-2" id="select-choice-2">
		        <option value="AL">Alabama</option>
		        <option value="AK">Alaska</option>
		
	        </select>
        </div>

        <div id="daySelect" data-role="fieldcontain">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="select-choice-month">Month</label>
                <select name="select-choice-month" data-mini="true" id="select-choice-month">
                    <option>day</option>
                    <option value="jan">January</option>
                </select>
                <label for="select-choice-day">Day</label>
                <select name="select-choice-day" data-mini="true" id="select-choice-day">
                    <option>start</option>
                    <option value="1">1</option>
                </select>
                <label for="select-choice-year">Year</label>
                <select name="select-choice-year" data-mini="true" id="select-choice-year">
                    <option>end</option>
                    <option value="2011">2011</option>
                </select>
            </fieldset>
        </div>

        <button data-theme="a" data-icon="back" data-mini="true">Back</button>
        <button data-theme="a" data-icon="grid" data-mini="true">Menu</button>
        <button data-theme="a" data-icon="search" data-mini="true">Search</button>
	     
    </div>
    <script type="text/javascript">
    $( "#popupPanel" ).on({
        popupbeforeposition: function() {
            var h = $( window ).height();

            $( "#popupPanel" ).css( "height", h );
           
        }
    });
    </script>
    <!-- end of popup filter -->

    <!-- begin of content -->
    <div data-role="content">
	<ul data-role="listview"  data-autodividers="true" data-filter="true">
		<?php $i = 0; ?>
		
		<?php foreach ($courses as $course): ?>
        
            <?php if ($i < 500)  :?>
                <li><a href="courses/course/<?php echo $course['course_unique']; ?> "><?php echo $course['title'] ?></a></li>
                <?php  $i++ ?>
            <?php endif ?>
   
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

