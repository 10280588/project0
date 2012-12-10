loaded
<?php
if(empty($courses))
{
    echo '<h1> You are not enrolled in any course </h1>';
}
else
{
    print_r($courses);
    echo '<h1> My Courses </h1>';
    foreach($courses as $course)
    {
        echo '<h1>'. $course['title'] .'</h1>';
        echo '<p>'. $course['course_unique'] .'</p>';
    }
}
?>
ended
