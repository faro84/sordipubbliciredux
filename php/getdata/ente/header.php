<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT cod_ente, descrizione_ente, cod_provincia, cod_regione, cod_comune"
        . " FROM soldipubblici_notebook.enti_spesatotale" 
        . " WHERE cod_ente ='" . $_GET["cod_ente"] . "';";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            if($row["cod_comune"] != "")
            {
                $sql2 = "SELECT descrcomune"
                    . " FROM soldipubblici_notebook.anagrafe" 
                    . " WHERE cod_comune ='" . $row["cod_comune"] . "'"
                    . " AND cod_provincia = '" . $row["cod_provincia"] . "';";
                //echo $sql2;
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        echo "<button class=\"btn bgm-deeporange btn-lg\"onclick=\"location.href='index.php?content=comune&&cod_com=" 
                            . $row["cod_comune"] ."&&cod_prov=" . $row["cod_provincia"] . "';\">" . $row2["descrcomune"] . "</a></button>";
                        break;
                    }
                }
            }
            
            if($row["cod_provincia"] != "")
            {
                $sql2 = "SELECT descrprovincia"
                    . " FROM soldipubblici_notebook.anagrafe" 
                    . " WHERE cod_provincia = '" . $row["cod_provincia"] . "';";
                //echo $sql2;
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        echo "<button class=\"btn bgm-deeporange btn-lg\"onclick=\"location.href='index.php?content=provincia&&cod_prov="
                            . $row["cod_provincia"] . "';\">" . $row2["descrprovincia"] . "</a></button>";
                        break;
                    }
                }
            }
            
            if($row["cod_regione"] != "")
            {
                $sql2 = "SELECT descrregione"
                    . " FROM soldipubblici_notebook.anagrafe" 
                    . " WHERE cod_regione = '" . $row["cod_regione"] . "';";
                //echo $sql2;
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        echo "<button class=\"btn bgm-deeporange btn-lg\"onclick=\"location.href='index.php?content=regione&&cod_reg="
                            . $row["cod_provincia"] . "';\">" . $row2["descrregione"] . "</a></button>";
                        break;
                    }
                } 
            }
            
            echo "  \\\  ";
            echo "<button class=\"btn bgm-red btn-lg\">" . $row["descrizione_ente"] . "</button>";
            break;
        }
    }
    $conn->close();

