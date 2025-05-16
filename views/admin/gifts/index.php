<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__chart">
    <canvas id="gift-chart"></canvas>
</div>

<?php 
    $view_scripts = $view_scripts ?? [];
    $view_scripts[] = '/build/js/gifts.js';
?>