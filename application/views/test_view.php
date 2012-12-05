<?php 
reset($courses);
$course = current($courses);
?>

    <h2><?php echo $course['title'] ?></h2>
    <div id="main">       
        <p><?php echo $course['course_unique']?></p>
        <p><?php echo $course['description']?></p>
        <p><?php echo 'department short name:'. $course['short_name']?></p>
        <p><?php echo 'department:'. $course['dept_number']?></p>
        <h1> Faculty model: </h1>
        <?php foreach($faculty as $facl): ?>
        <p><?php echo $facl['prefix'] .' '. $facl['first_name'] .' '. $facl['middle_name'] .' '. $facl['last_name'] .' '. $facl['suffix']?></p>
        <?php endforeach ?>
        <?php foreach($schedule as $sched): ?>
        <p><?php echo 'day:'. $sched['short_name'] .' begin time:'. $sched['begin_time'] .' end time:'. $sched['end_time']?></p>
        <?php endforeach ?>
    </div>
