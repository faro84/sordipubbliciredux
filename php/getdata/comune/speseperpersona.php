<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $codCom = filter_input (INPUT_GET, 'cod_com', FILTER_SANITIZE_STRING);
        $codProv = filter_input (INPUT_GET, 'cod_prov', FILTER_SANITIZE_STRING);
    $sql = "SELECT TOTALEPERCITTADINO FROM soldipubblici_notebook.comuni_spesatotale" . 
            " WHERE cod_comune = '" . $codCom . "' AND cod_provincia= '" . $codProv . "';";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
            echo round($row["TOTALEPERCITTADINO"]);
        }
    }
    $conn->close();

