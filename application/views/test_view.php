<?php foreach ($courses as $course): ?>

    <h2><?php echo $course['title'] ?></h2>
    <div id="main">       
        <p><?php echo $course['course_unique']?></p>
        <p><?php echo $course['description']?></p>
    </div>

<?php endforeach ?>
