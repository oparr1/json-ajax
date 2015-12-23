<?php

    // Escape output safely - only use on echo / OUTPUT
    function html($data) {
        $data = htmlspecialchars($data, ENT_QUOTES); // <>
        return $data;
    }

    // Sanitise and isset/empty data
    function clean_input($data, $default = NULL) {
        // Sanitise data
        $data = trim($data);
        $data = stripslashes($data);
        // return isse, not empty and POST
        return isset($_POST[$data]) ? $_POST[$data] : $default;
    }

    // Isset GET
    function get_set($data, $default = NULL) {

        return isset($_GET[$data]) ? $_GET[$data] : $default;
    }

        /*
    // if GET isset
    if (isset($_GET['id'])) {

        // If GET not null 
        if ($_GET['id'] != null && $_GET['code'] != null) {

            // Store GET variables in a session
            $_SESSION['id'] = $_GET['id'];
            $_SESSION['code'] = $_GET['code'];
        }
    }
    */

