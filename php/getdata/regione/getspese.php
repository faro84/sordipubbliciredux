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
        
        $codReg = filter_input (INPUT_GET, 'cod_reg', FILTER_SANITIZE_STRING);
        
        $sql = "SELECT totale, descrizione, totalepercittadino, coddescrizione" 
                . " FROM soldipubblici_notebook.regioni_spesatotale_per_tipologia"
                . " WHERE cod_regione = '" . $codReg . "'"
                . " ORDER BY totale DESC;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $tableelement = new TableElement();
                $tableelement->totale = $row["totale"];
                $tableelement->descrizione = $row['descrizione'];
                $tableelement->totalepersona = $row['totalepercittadino'];
                $tableelement->coddescrizione = $row['coddescrizione'];
                $tableelement->anno1 = "0";
                $tableelement->anno2 = "0";
                $tableelement->anno3 = "0";
                array_push($tableElements, $tableelement);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $sql2 = "SELECT totale, anno FROM soldipubblici_notebook.regioni_spesatotale_per_anno_per_tipologia"
                    . " WHERE coddescrizione = '". $tableElement->coddescrizione . "' "
                    . " AND cod_regione = '" . $codReg . "';";
//            echo $sql2;
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0)
            {
                while($row2 = $result2->fetch_assoc())
                {
                    if($row2['anno'] == "2013"){
                        $tableElement->anno1 = $row2['totale'];
                    }
                    else if($row2['anno'] == "2014"){
                        $tableElement->anno2 = $row2['totale'];
                    }
                    else if($row2['anno'] == "2015"){
                        $tableElement->anno3 = $row2['totale'];
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
            echo "</tr>";
            
            $index++;
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";

