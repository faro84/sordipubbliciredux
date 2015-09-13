<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $codTip = filter_input (INPUT_GET, 'cod_tip', FILTER_SANITIZE_STRING);
    if($_GET["content"] == "ct")
    {
        $sql = "SELECT descrizione" 
            . " FROM soldipubblici_notebook.comuni_spesatotale_per_anno_per_tipologia"
            . " WHERE coddescrizione = '" . $codTip . "' LIMIT 1";
    }
    else if($_GET["content"] == "et")
    {
        $sql = "SELECT descrizione" 
            . " FROM soldipubblici_notebook.enti_spesatotale_per_anno_per_tipologia"
            . " WHERE coddescrizione = '" . $codTip . "' LIMIT 1";
    }
    else if($_GET["content"] == "ept")
    {
        $sql = "SELECT descrizione" 
            . " FROM soldipubblici_notebook.enti_spesatotale_per_anno_per_tipologia"
            . " WHERE coddescrizione = '" . $codTip . "' LIMIT 1";
    }
    else if($_GET["content"] == "ept")
    {
        $sql = "SELECT descrizione" 
            . " FROM soldipubblici_notebook.enti_spesatotale_per_anno_per_tipologia"
            . " WHERE coddescrizione = '" . $codTip . "' LIMIT 1";
    }
    
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
            echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrizione"] . "</button>";
            break;
        }
    }
    $conn->close();

