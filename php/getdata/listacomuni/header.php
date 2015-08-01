<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_GET["cod_prov"]))
    {
        $sql = "SELECT cod_ripartizione, descrripartizione, cod_regione, descrregione, cod_provincia, descrprovincia, cod_comune, descrcomune"
            . " FROM soldipubblici_notebook.anagrafe" 
            . " WHERE cod_provincia='" . $_GET["cod_prov"] . "';";
        //echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                echo "<button class=\"btn bgm-orange btn-lg\"onclick=\"location.href='index.php?content=ripartizione&&cod_rip=" 
                    . $row["cod_ripartizione"] ."';\">" . $row["descrripartizione"] . "</button>";
                echo "  \\\  ";
                echo "<button class=\"btn bgm-deeporange btn-lg\"onclick=\"location.href='index.php?content=regione&&cod_reg=" 
                    . $row["cod_regione"] ."';\">" . $row["descrregione"] . "</button>";
                echo "  \\\  ";
                echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrprovincia"] . "</button>";
                break;
            }
        }
    }
    elseif(isset($_GET["cod_reg"]))
    {
        $sql = "SELECT cod_ripartizione, descrripartizione, cod_regione, descrregione, cod_provincia, descrprovincia, cod_comune, descrcomune"
            . " FROM soldipubblici_notebook.anagrafe" 
            . " WHERE cod_regione = '" . $_GET["cod_reg"] . "';";
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
    }
    else if(isset($_GET["cod_rip"]))
    {
        $sql = "SELECT cod_ripartizione, descrripartizione, cod_regione, descrregione, cod_provincia, descrprovincia, cod_comune, descrcomune"
            . " FROM soldipubblici_notebook.anagrafe" 
            . " WHERE cod_ripartizione = '" . $_GET["cod_rip"] . "';";
        //echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrripartizione"] . "</button>";
                break;
            }
        }
    }
    
    $conn->close();

