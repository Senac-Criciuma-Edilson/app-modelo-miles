<?php

    $sql    = "SELECT * FROM td_usuario ORDER BY id DESC;";
    $query  = $conn->query($sql);
    $dados  = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($dados);