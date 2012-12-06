<p>loaded</p>
<?php 
//reset($results);
//$result = current($results);
//echo Print_r($results);
foreach($results as $result):
//echo Print_r($result);
?>
    <h2><?php echo $result['title'] ?></h2>      
    <p><?php echo $result['course_unique']?></p>
<?php endforeach ?>
<p>ended</p>
