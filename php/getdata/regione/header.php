<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $codReg = filter_input (INPUT_GET, 'cod_reg', FILTER_SANITIZE_STRING);
    
    $sql = "SELECT cod_ripartizione, descrripartizione, cod_regione, descrregione, cod_provincia, descrprovincia, cod_comune, descrcomune"
        . " FROM soldipubblici_notebook.anagrafe" 
        . " WHERE cod_regione = '" . $codReg . "';";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
            echo "<button class=\"btn bgm-deeporange btn-lg\"onclick=\"location.href='index.php?content=ripartizione&&cod_rip=" 
                . $row["cod_ripartizione"] ."';\">" . $row["descrripartizione"] . "</button>";
            echo "  \\\  ";
            echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrregione"] . "</button>";
            break;
        }
    }
    $conn->close();

