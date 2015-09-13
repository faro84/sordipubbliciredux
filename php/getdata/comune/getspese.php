<?php

        echo "<table id=\"data-table-basic\" class=\"table table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th data-column-id=\"id\" data-type=\"numeric\">Nr.</th>";
        echo "<th data-column-id=\"descrizione\" data-type=\"text\" data-formatter=\"mylink\">Descrizione</th>";
        echo "<th data-column-id=\"total\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale\">Totale</th>";
        echo "<th data-column-id=\"totalyear1\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale1\">Totale 2013</th>";
        echo "<th data-column-id=\"totalyear2\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale2\">Totale 2014</th>";
        echo "<th data-column-id=\"totalyear3\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale3\">Totale 2015</th>";
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
        
        class TableElement
        {
            public $descrizione;
            public $coddescrizione;
            public $totale;
            public $totalepersona;
            public $anno1;
            public $anno2;
            public $anno3;
        }
        
        $codCom = filter_input (INPUT_GET, 'cod_com', FILTER_SANITIZE_STRING);
        $codProv = filter_input (INPUT_GET, 'cod_prov', FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM soldipubblici_notebook.comuni_spesatotale_per_tipologia" .
                " WHERE cod_comune = '" . $codCom . "' AND cod_provincia= '" . $codProv . "'" . 
                " ORDER BY TOTALE DESC;";
        echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        $i = 0;
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                if($i == 0)
                    echo "totale totale: " . $row["TOTALE"]. "</br>";
                $tableelement = new TableElement();
                $tableelement->totale = $row["TOTALE"];
                $tableelement->descrizione = $row['DESCRIZIONE'];
                $tableelement->totalepersona = $row['TOTALEPERCITTADINO'];
                $tableelement->coddescrizione = $row['CODDESCRIZIONE'];
                $tableelement->anno1 = "0";
                $tableelement->anno2 = "0";
                $tableelement->anno3 = "0";
                array_push($tableElements, $tableelement);
                $i++;
            }
        }
        $i = 0;
        foreach($tableElements as $tableElement)
        {
            $sql2 = "SELECT * FROM soldipubblici_notebook.comuni_spesatotale_per_anno_per_tipologia"
                    . " WHERE coddescrizione = '". $tableElement->coddescrizione . "' "
                    . " AND cod_comune = '" . $codCom . "' AND cod_provincia= '" . $codProv . "';";
            //echo $sql2;
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0)
            {
                while($row2 = $result2->fetch_assoc())
                {
                    if($row2['ANNO'] == "2013"){
                        $tableElement->anno1 = $row2['TOTALE'];
                    }
                    else if($row2['ANNO'] == "2014"){
                        $tableElement->anno2 = $row2['TOTALE'];
                    }
                    else if($row2['ANNO'] == "2015"){
                        $tableElement->anno3 = $row2['TOTALE'];
                    }
                    
                    if($i == 0)
                    {
                        echo $row2["TOTALE"] . "</br>";
                    }
                }
                $i++;
            }
        }
        
        $index = 1;
        
        foreach($tableElements as $tableElement)
        {
            echo "<tr>";
            echo "<td>" . $index . "</td>";
            echo "<td>" . $tableElement->descrizione . "</td>";
            echo "<td>" . $tableElement->totale . "</td>";
            echo "<td>" . $tableElement->anno1 . "</td>";
            echo "<td>" . $tableElement->anno2 . "</td>";
            //echo "<td>" . number_format(floor($tableElement->anno3), 0, ",", ".") . "</td>";
            echo "<td>" . $tableElement->anno3 . "</td>";
            echo "<td>" . $tableElement->coddescrizione . "</td>";
            echo "</tr>";
            
            $index++;
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";