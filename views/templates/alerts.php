<?php 

$alertsToValidate = $alerts ?? [];

foreach($alertsToValidate as $type => $messages):
        foreach ($messages as $message): 
?>
            <div class="alert alert__<?php echo $type ?>">
                <?php echo $message; ?>
            </div>
<?php   
        endforeach;
endforeach; 
?>