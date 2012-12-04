<div data-role="page" class="individual" data-theme="a" >

	<div data-role="header" data-position="inline">
	<a href="index.html" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="notext">Back</a>
	 <?php foreach($courses as $course): ?>
	<h1>Course Info</h1>
	<a href="index.html" data-icon="plus" class="ui-btn-right">Add</a>
	</div>

<?php /**  Your app must enable users to see courses’ catalog numbers,
 titles, departments, descriptions, instructors, locations, and days and times. */ ?>
 
<div data-role="content">
   
    <h2><?php echo $course['title'];?></h2>
    <div data-role="collapsible" data-inset="false">
        <h3>Description</h3>
        <p id="description" ><?php echo $course['description'];?></p>
    </div>
    <div data-role="collapsible" data-inset="false">
        <h3>Additional Information</h3>
        <p><span class="bold">Department:</span> Earth and Planetary Sciences</p>
        <p><span class="bold">Catalog number:</span> <?php echo $course['cat_num'];?></p>
        <p><span class="bold">When:</span> <?php echo $course['year'];?></p>
        <p><span class="bold">Instructors:</span> <?php echo $course['year'];?></p>
        <p><span class="bold">Locations:</span>
    </div>
    <div data-role="collapsible" data-inset="false">
        <h3>Notes</h3>
        <p id="description" ><?php echo $course['notes'];?></p>
    </div>
    
    
    <input type="submit" value="Add to Basket" >
    
</div>

    <div id="greyArea">
        <div id="content" data-role="content">
            <table>
                <tr>
                <th>Type</th>
                <th>Day</th>
                <th class="time">Time</th>
                <th>Req</th>
                <tr>
                    <td>Lecture</td>
                    <td>Mon</td>
                    <td class="time">
                       29:00-22:00
                    </td>
                    <td> Yes </td>
                </tr>
                <tr>
                    <td>Lecture</td>
                    <td>Mon</td>
                    <td class="time">
                       29:00-22:00
                    </td>
                    <td> Yes </td>
                </tr>
                <tr>
                    <td>Lecture</td>
                    <td>Mon</td>
                    <td class="time">
                       29:00-22:00
                    </td>
                    <td> Yes </td>
                </tr>
                <tr>
                    <td>Lecture</td>
                    <td>Mon</td>
                    <td class="time">
                       9:00-1:00
                    </td>
                    <td> Yes </td>
                </tr>
            </table>
        </div>
    </div>
   
    
    <?php endforeach ?>



<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
		<ul>
			<li><a href="/"  data-icon="home">Home</a></li>
			<li><a href="#"  data-icon="search">Search</a></li>
			<li><a href="#"  data-icon="alert">Basket</a></li>
			<li><a href="#"  data-icon="info">Info</a></li>
		</ul>
	</div><!-- /navbar -->
	</div><!-- /footer -->
