<?php

    $id     = $_GET['id'];
    $sql    = "SELECT * FROM td_usuario WHERE id = $id;";
    $query  = $conn->query($sql);
    $dados  = $query->fetch(PDO::FETCH_OBJ);

    echo json_encode($dados);