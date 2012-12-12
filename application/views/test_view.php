<p>loaded</p>
<?php 
        echo '<h1>operator '. $operator .'</h1>'; 
        echo '<h1>checks: '. $checks .'</h1>';
        echo '<h1>facultycheck '. $facultyCheck .'</h1>'; 
        echo '<h1>titlecheck '. $titleCheck .'</h1>'; 
        echo '<h1>descriptioncheck '. $descriptionCheck .'</h1>'; 
        
        echo '<h1>day '. $day .'</h1>';
        echo '<h1>time '. $time .'</h1>'; 
	    echo '<h1>begintime '. $beginTime .'</h1>'; 
        echo '<h1>endtime '. $endTime .'</h1>';
        
        echo '<h1>department '. $department .'</h1>';
        echo '<h1>gened '. $gened .'</h1>';

        foreach($results as $course)
        {
            echo '<h1>'. $course['title'] .'</h1>';
        }
 ?>
<p>ended</p>

