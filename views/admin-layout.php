<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevWebCamp <?php echo isset($title) ? ' | ' . $title : '' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body class="dashboard">
    <?php 
        include_once __DIR__ .'/templates/admin-header.php';
    ?>
    <div class="dashboard__container">
        <?php
            include_once __DIR__ .'/templates/admin-sidebar.php';  
        ?>

        <main class="dashboard__content">
            <?php 
                echo $content; 
            ?> 
        </main>
    </div>

    <?php 
    $scripts = $view_scripts ?? [];
    if (!empty($scripts)): 
        foreach($scripts as $script_path):
    ?>
            <script src="<?php echo htmlspecialchars($script_path); ?>" defer></script>
    <?php endforeach; ?>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js"></script>
</body>
</html>