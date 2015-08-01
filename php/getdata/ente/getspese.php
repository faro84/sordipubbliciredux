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
        echo "<th data-column-id=\"tipologia\" data-type=\"string\" data-visible=\"false\">isProvincia</th>";
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
        
        class EnteElement
        {
            public $descrizione;
            public $coddescrizione;
            public $totale;
            public $totalepersona;
            public $anno1;
            public $anno2;
            public $anno3;
        }
        
        $sql = "SELECT * FROM soldipubblici_notebook.enti_spesatotale_per_tipologia" .
                " WHERE cod_ente = '" . $_GET["cod_ente"] . "'" . 
                " ORDER BY TOTALE DESC;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $tableelement = new EnteElement();
                $tableelement->totale = $row["TOTALE"];
                $tableelement->descrizione = $row['DESCRIZIONE'];
                $tableelement->totalepersona = $row['TOTALEPERCITTADINO'];
                $tableelement->coddescrizione = $row['CODDESCRIZIONE'];
                $tableelement->anno1 = "0";
                $tableelement->anno2 = "0";
                $tableelement->anno3 = "0";
                array_push($tableElements, $tableelement);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $sql2 = "SELECT * FROM soldipubblici_notebook.enti_spesatotale_per_anno_per_tipologia"
                    . " WHERE coddescrizione = '". $tableElement->coddescrizione . "' "
                    . " AND cod_ente = '" . $_GET["cod_ente"] . "';";
//            echo $sql2;
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
                }
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
            echo "<td>Ente</td>";
            echo "</tr>";
            
            $index++;
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";

