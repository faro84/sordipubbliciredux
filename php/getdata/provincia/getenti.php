<?php

        echo "<table id=\"data-table-lista-enti-basic\" class=\"table table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th data-column-id=\"id\" data-type=\"numeric\">Nr.</th>";
        echo "<th data-column-id=\"descrizione\" data-type=\"text\" data-formatter=\"mylinkenticomune\">Descrizione</th>";
        echo "<th data-column-id=\"total\" data-type=\"numeric\" data-formatter=\"numberFormatterTotaleEnte\">Totale</th>";
        echo "<th data-column-id=\"codice\" data-identifier=\"true\" data-type=\"string\" data-visible=\"false\">Codice</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        $username = "root"; 
        $password = "root";   
        $host = "localhost";
        $database= "soldipubblici_notebook";

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $codProv = filter_input (INPUT_GET, 'cod_prov', FILTER_SANITIZE_STRING);
        
        $sql = "SELECT * FROM soldipubblici_notebook.enti_spesatotale"
                . " WHERE cod_comune = '' "
                . "AND cod_provincia= '" . $codProv . "'"
                . " ORDER BY TOTALE DESC;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        $index = 1;
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                if($row["TIPOLOGIA_ENTE"] != "Provincia")
                {
                    echo "<tr>";
                    echo "<td>" . $index . "</td>";
                    echo "<td>" . $row["DESCRIZIONE_ENTE"] . "</td>";
                    echo "<td>" . $row["TOTALE"] . "</td>";
                    echo "<td>" . $row["COD_ENTE"] . "</td>";
                    echo "</tr>";

                    $index++;    
                }
            }
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";

