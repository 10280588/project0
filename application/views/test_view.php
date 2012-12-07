<p>loaded</p>
<?php 
reset($results);
$res = current($results);
foreach($results as $result):
?>
    <h2><?php echo $result['title'] ?></h2>      
    <p><?php echo $result['course_unique']?></p>
<?php endforeach ?>
<p>ended</p>
