<?php

    $id     = $_POST['id'];
    $nome   = $_POST['nome'];
    $login  = $_POST['login'];
    $senha  = $_POST['senha'];

    if ($id == 0){
        $sql    = "
            INSERT INTO td_usuario (nome,login,senha)
            VALUES ('$nome','$login',SHA2('$senha',256));
        ";
    }else{
        $sql    = "
            UPDATE td_usuario SET
            nome = '$nome', login = '$login'
            WHERE id = $id;
        ";
    }
    
    $executar = $conn->exec($sql);
    echo json_encode(
        array(
            'status' => $executar
        )
    );