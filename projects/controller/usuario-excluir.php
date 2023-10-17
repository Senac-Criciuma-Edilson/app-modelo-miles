<?php

    $id     = $_GET['id'];
    $sql    = "DELETE FROM td_usuario WHERE id = $id;";
    $query  = $conn->exec($sql);