<?php

    // Limpa a tabela destino
    $conn->exec("TRUNCATE TABLE {$para_entidade};");

    // Seleciona os dados da tabela de origem
    $sql        = "SELECT * FROM {$de_entidade};";   
    $query      = $connProd->query($sql);
    while ($de  = $query->fetch())
    {
        // Adiciona registros na tabela de destino        
        $para                       = tdc::p($para_entidade);
        $para->id                   = $de['id'];
        $para->host                 = $de['host'];
        $para->base                 = $de['base'];
        $para->porta                = $de['porta'];
        $para->usuario              = $de['usuario'];
        $para->senha                = $de['senha'];
        $para->tipo                 = $de['tipo'];

        $para->armazenar();
    }