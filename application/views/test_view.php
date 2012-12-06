<p>loaded</p>
<?php 
reset($results);
$res = current($results);
//echo Print_r($results);
echo '<h1>'. $res['short_name'] .'</h1>';
foreach($results as $result):
//echo Print_r($result);
?>
    <h2><?php echo $result['title'] ?></h2>      
    <p><?php echo $result['course_unique']?></p>
<?php endforeach ?>
<p>ended</p>
