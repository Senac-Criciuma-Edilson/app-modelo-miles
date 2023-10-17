<?php

    $login  = $_POST['login'];
    $senha  = $_POST['senha'];

    $sql    = "
        SELECT id,nome 
        FROM td_usuario 
        WHERE login = '$login' 
        AND senha = SHA2('$senha',256);
    ";
    $query = $conn->query($sql);

    if ($query->rowCount() > 0){
        $linha = $query->fetch(PDO::FETCH_OBJ);
        $token = md5( $linha->id . date('Ymdhis'));

        $_SESSION['_token'] = $token;
        
        $retorno = array(
            'status'    => 'success',
            'user_id'   => $linha->id,
            'user_name' => $linha->nome,
            'token'     => $token
        );
    }else{
        $retorno = array(
            'status'    => 'error',
            'error'     => 1
        );
    }

    echo json_encode($retorno);