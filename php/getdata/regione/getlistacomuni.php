<?php

        echo "<table id=\"data-table-lista-comuni-basic\" class=\"table table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th data-column-id=\"descrizione\" data-type=\"text\" data-formatter=\"mylink\">Descrizione</th>";
        echo "<th data-column-id=\"total\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale\">Totale</th>";
        echo "<th data-column-id=\"totalyear1\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale1\">Totale 2013</th>";
        echo "<th data-column-id=\"totalyear2\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale2\">Totale 2014</th>";
        echo "<th data-column-id=\"totalyear3\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale3\">Totale 2015</th>";
        echo "<th data-column-id=\"codiceComune\" data-identifier=\"true\" data-type=\"string\" data-visible=\"false\">Codice</th>";
        echo "<th data-column-id=\"codiceProvincia\" data-identifier=\"true\" data-type=\"string\" data-visible=\"false\">Codice</th>";
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
        
        $sql = "SELECT comuni_spesatotale.cod_comune, descrcomune, totale, totalepercittadino,comuni_spesatotale.cod_provincia"
                . " FROM soldipubblici_notebook.comuni_spesatotale"
                . " JOIN soldipubblici_notebook.anagrafe"
                . " ON anagrafe.cod_comune = comuni_spesatotale.cod_comune "
                . " AND anagrafe.cod_provincia = comuni_spesatotale.cod_provincia"
                . " WHERE comuni_spesatotale.cod_regione = '" . $_GET["cod_reg"] . "'"
                . " ORDER BY TOTALE DESC;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        
        class ComuneRegione
        {
            public $descrizione;
            public $codcomune;
            public $codprovincia;
            public $totale;
            public $totalepersona;
            public $anno1;
            public $anno2;
            public $anno3;
        }
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $tableelement = new ComuneRegione();
                $tableelement->totale = $row["totale"];
                $tableelement->codcomune = $row["cod_comune"];
                $tableelement->codprovincia = $row["cod_provincia"];
                $tableelement->descrizione = $row['descrcomune'];
                $tableelement->totalepersona = $row['totalepercittadino'];
                $tableelement->anno1 = "0";
                $tableelement->anno2 = "0";
                $tableelement->anno3 = "0";
                array_push($tableElements, $tableelement);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $sql2 = "SELECT * FROM soldipubblici_notebook.comuni_spesatotale_per_anno_per_tipologia"
                    . " WHERE cod_comune = '". $tableElement->codcomune . "'"
                    . " AND cod_provincia = '" . $tableElement->codprovincia . "';";
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
                }
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            echo "<tr>";
            echo "<td>" . $tableElement->descrizione . "</td>";
            echo "<td>" . $tableElement->totale . "</td>";
            echo "<td>" . $tableElement->anno1 . "</td>";
            echo "<td>" . $tableElement->anno2 . "</td>";
            echo "<td>" . $tableElement->anno3 . "</td>";
            echo "<td>" . $tableElement->codcomune . "</td>";
            echo "<td>" . $tableElement->codprovincia . "</td>";
            echo "</tr>";
            
            $index++;
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";