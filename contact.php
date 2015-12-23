<?php
require_once '/app/functions/sanitise.php';
require_once '/app/contact/contact_php.php';
    $name = clean_input('name');
    $email = clean_input('email');
    $message = clean_input('message');
?>
<!DOCTYPE html>
<html>
    <head>
    </head>

    <body>
      <h2>POST AJAX</h2>
    <form id="contactForm" action="contact.php" method="POST" novalidate>
        <!-- Success/Error message on submit when js disabled -->
        <div id="message">
          <?php
          if (isset($response['failed']) && isset($response['success'])) {
            $response['failed'];
            $response['success'];
          }
          ?>
        </div>
        <div class ="form-group">
                <label class="required">Name</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Name" value="<?php echo html($name); ?>">
                <?php if(isset($errors["name"])) echo $errors['name']; ?>
        </div>

        <div class ="form-group">
                <label class="required">Email</label>
                <input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo html($email); ?>">
                <?php if(isset($errors["email"])) echo $errors['email']; ?>
        </div>

        <div class ="form-group">
                <label class="required">Message</label>
                <textarea id="message" class="form-control" name="message" rows="7" placeholder="Message"><?php echo html($message); ?></textarea>
                <?php if(isset($errors["message"])) echo $errors['message']; ?>
        </div>

        <div class="form-group">
          <button class="submit" type="submit">Submit</button>
        </div>  
    </form>

    <div id="errors"></div>

    <!-- I can remove php errors and santise in values if i want ajax only -->

    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Post ajax -->
    <script>
    $(document).ready(function() {
        $('#contactForm').submit(function(event) {
        // Prevent form submit
        event.preventDefault();

        // Serialise
        var data = $("#contactForm").serialize();

        // AJAX POST
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: data,
            url: "app/contact/contact.php",
            success: function(data) {
                // Remove previous errors to stop repeating
                $('.errors').remove();
                $('.success').remove();

                // If errors are true - response['errors'];
                if(data.errors){
                  // Error summary - loop object
                  $.each(data.errorSummary, function (key, item) {
                      $("#contactForm").before('<ul><li class="errors" style="color: #ff0000;">' + item + '</li></ul>')
                  });

                  // Individual errors
                  $('input#name').after("<span class='errors' style='color: #ff0000;'>"+data.name+"</span>");
                  $('input#email').after("<span class='errors' style='color: #ff0000;'>"+data.email+"</span>");
                  $('textarea#message').after("<span class='errors' style='color: #ff0000;''>"+data.message+"</span>");
                }
                // If success is true - response['success'];
                else if (data.success) {
                  $('#contactForm').before("<div class='success' style='color: #00ff00;'>"+data.success+"</p>");
                }
                // If failed is true - response['failed'];
                else if (data.failed) {
                  $('#contactForm').before("<div class='errors' style='color: #ff0000;'>"+data.failed+"</p>");
                }
            }
           });
        });              
    });
  </script>

  </body>
</html>