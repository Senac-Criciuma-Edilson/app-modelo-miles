<?php
    $token_get      = isset($_GET['token']) ? $_GET['token'] : '';
    $token_session  = isset($_SESSION['_token']) ? $_SESSION['_token'] : '';
    echo json_encode( $token_get == $token_session );