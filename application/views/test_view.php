<?php foreach($courses as $course): ?>

    <h2><?php echo $course['title'] ?></h2>
    <div id="main">       
        <p><?php echo $course['course_unique']?></p>
        <p><?php echo $course['description']?></p>
        <p><?php echo 'department short name:'. $course['short_name']?></p>
        <p><?php echo 'department:'. $course['dept_number']?></p>
        <p><?php echo $course['prefix'] .' '. $course['first_name'] .' '. $course['middle_name'] .' '. $course['last_name'] .' '. $course['suffix']?></p>
        <p><?php echo 'day:'. $course['day'] .' begin time:'. $course['begin_time'] .' end time:'. $course['end_time']?></p>
    </div>
<?php endforeach ?>
