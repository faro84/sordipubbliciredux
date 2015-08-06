<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $codRip = filter_input (INPUT_GET, 'cod_rip', FILTER_SANITIZE_STRING);
    //echo $codRip;
    
    $sql = "SELECT cod_ripartizione, descrripartizione, cod_regione, descrregione, cod_provincia, descrprovincia, cod_comune, descrcomune"
        . " FROM soldipubblici_notebook.anagrafe" 
        . " WHERE cod_ripartizione = '" . $codRip . "';";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
            echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrripartizione"] . "</button>";
            break;
        }
    }
    $conn->close();

