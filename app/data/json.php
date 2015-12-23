<?php require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");?>
<?php header('Content-Type: application/json'); ?>

        <?php $conn = mysqliConnected(); ?>

        <?php 
            $json = [];
            if ($result = $conn->query("SELECT code, name, continent FROM country WHERE name = 'United Kingdom' ")) : ?>

                <?php while($row = $result->fetch_array(MYSQLI_ASSOC)) : ?>       
                    <?php $json[] = $row; ?>
                <?php endwhile ?>
            <?php endif ?>

            <?php echo json_encode($json, JSON_PRETTY_PRINT); ?>
        
        <?php  $conn->close(); ?>