<div data-role="page" id="advancedSearch" data-theme="a">
    
     <!-- begin of header -->
	<div data-role="header" data-position="inline">
	    <a href="index.html" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="notext">Back</a>
	    <h1>Advanced Search</h1>
	</div>
    <!-- end of header -->
    
    
    <div data-role="content" class="ui-content" role="main">
        
        
        <form action="form.php" method="get">
            <input type="text" data-type="search" name="search" id="search-basic" value="" class="ui-input-text ui-body-a">
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
                <select name="select-choice-month"  id="select-choice-month">
                    <option>day</option>
                    <option value="jan">January</option>
                </select>
                <label for="select-choice-day">Day</label>
                <select name="select-choice-day"  id="select-choice-day">
                    <option>start</option>
                    <option value="1">1</option>
                </select>
                <label for="select-choice-year">Year</label>
                <select name="select-choice-year"  id="select-choice-year">
                    <option>end</option>
                    <option value="2011">2011</option>
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
			    <li><a href="/"  data-icon="home">Home</a></li>
			    <li><a href="#"  data-icon="search">Search</a></li>
			    <li><a href="#"  data-icon="alert">Basket</a></li>
			    <li><a href="#"  data-icon="info">Info</a></li>
		    </ul>
	    </div>
    </div>
    <!-- end of footer -->

</div><!--- end of page -->

