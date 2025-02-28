<!DOCTYPE html>
<html lang="en">

<head>
 <?= $this->include('layouts/head') ?>   
</head>

<body>
    <!-- BEGIN #app -->
    <?php 
    if (in_array($main_content, array('inventory/add_inventory')) || in_array($main_content, array('inventory/detail'))):?>
        <div id="app" class="app app-sidebar-minified">
    <?php else:?>
        <div id="app" class="app">
    <?php endif;?>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <?php header("Location:".URL);
            exit();
        ?> 
        <?php else :?>
        <?= $this->include('layouts/header') ?> 
        <?= $this->include('layouts/sidebar') ?>    
        <?= $this->include($main_content) ?>    

        <?= $this->include('layouts/footer') ?>     
        <?php endif ;?>

    </div>    
    
</body>

</html>