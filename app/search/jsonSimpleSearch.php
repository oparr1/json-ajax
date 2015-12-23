<?php require_once("$_SERVER[DOCUMENT_ROOT]app/config/database.php");?>
<?php require_once("$_SERVER[DOCUMENT_ROOT]app/functions/sanitise.php");?>
<?php header('Content-Type: application/json'); ?>

        <?php $conn = mysqliConnected(); ?>

        <?php 
            $json = [];
            if($statement = $conn->prepare("SELECT code, name, continent
                      FROM Country 
                      WHERE name = ? 
                      LIMIT 1")) : ?>
                          
              <?php 
              $statement->bind_param('s', $country);
              $country = clean_input('country');
              $statement->execute();
              $result = $statement->get_result(); ?>


                <?php while($row = $result->fetch_array(MYSQLI_ASSOC)) : ?>    
                    <?php $json = $row['name']; ?>
                <?php endwhile ?>
            <?php endif ?>

            <?php echo json_encode($json, JSON_PRETTY_PRINT); ?>       

        <?php  $conn->close(); ?>