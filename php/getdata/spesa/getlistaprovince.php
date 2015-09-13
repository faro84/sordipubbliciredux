<?php

        echo "<table id=\"data-table-lista-province-perspesa-basic\" class=\"table table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th data-column-id=\"descrizione\" data-type=\"text\" data-formatter=\"mylink\">Comune</th>";
        echo "<th data-column-id=\"total\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale\">Spesa Totale</th>";
        echo "<th data-column-id=\"totalyear1\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale1\">Totale 2013</th>";
        echo "<th data-column-id=\"totalyear2\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale2\">Totale 2014</th>";
        echo "<th data-column-id=\"totalyear3\" data-type=\"numeric\" data-formatter=\"numberFormatterTotale3\">Totale 2015</th>";
        echo "<th data-column-id=\"codiceProvincia\" data-type=\"string\" data-visible=\"false\">Codice</th>";
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
        
//        $sql = "SELECT cod_ente, descrizione_ente, totale, totalepercittadino, descrizione"
//                . " FROM soldipubblici_notebook.enti_spesatotale_per_tipologia "
//                . " WHERE coddescrizione = '" . $_GET["cod_tip"] . "'"
//                . " ORDER BY enti_spesatotale_per_tipologia.totale DESC"
//                . " LIMIT 200;";
        $codTip = filter_input (INPUT_GET, 'cod_tip', FILTER_SANITIZE_STRING);
        $sql = "SELECT enti_spesatotale.cod_ente,enti_spesatotale.cod_comune, tipologia_ente,enti_spesatotale.cod_provincia,"
                    . " enti_spesatotale_per_tipologia.totale,enti_spesatotale_per_tipologia.totalepercittadino,"
                    . " enti_spesatotale.cod_provincia,enti_spesatotale_per_tipologia.descrizione_ente,descrizione,coddescrizione"
                    . " FROM soldipubblici_notebook.enti_spesatotale_per_tipologia"
                    . " JOIN soldipubblici_notebook.enti_spesatotale"
                    . " ON enti_spesatotale.cod_ente = enti_spesatotale_per_tipologia.cod_ente"
                    . " WHERE coddescrizione = '" . $codTip . "'"
                    . " AND tipologia_ente = 'Provincia'"
                    . " ORDER BY enti_spesatotale_per_tipologia.totale DESC"
                    . " LIMIT 200;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        
        class SpesaComune
        {
            public $comune;
            public $descrizione;
            public $totale;
            public $totalepersona;
            public $descrizionespesa;
            public $cod_ente;
            public $cod_provincia;
            public $anno1;
            public $anno2;
            public $anno3;
        }
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                    $tableelement = new SpesaComune();
                    $tableelement->totale = $row["totale"];
                    $tableelement->cod_ente = $row["cod_ente"];
                    $tableelement->cod_provincia = $row["cod_provincia"];
                    $tableelement->descrizione = $row['descrizione_ente'];
                    $tableelement->totalepersona = $row['totalepercittadino'];
                    $tableelement->descrizionespesa = $row['descrizione'];
                    $tableelement->anno1 = "0";
                    $tableelement->anno2 = "0";
                    $tableelement->anno3 = "0";
                    array_push($tableElements, $tableelement);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $sql2 = "SELECT totale,anno"
                    . " FROM soldipubblici_notebook.enti_spesatotale_per_anno_per_tipologia"
                    . " WHERE cod_ente = '" . $tableElement->cod_ente . "'"
                    . " AND coddescrizione = '" . $codTip . "';";
            
            //echo $sql2 . PHP_EOL;
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
        
//        foreach($tableElements as $tableElement)
//        {
//            echo "<tr>";
//            echo "<td>" . $index . "</td>";
//            echo "<td><a href='index.php?content=com&&cod_com=" 
//                . $tableElement->cod_com . "&&cod_prov=" 
//                . $tableElement->cod_prov . "'>" 
//                . $tableElement->descrizione
//                . "</a><span class=\"badge\" style=\"float:right\">"
//                . number_format($tableElement->totalepersona, 0, ",", ".") . "</span></td>";
//            echo "<td>" . number_format($tableElement->totale, 0, ",", ".") . "</td>";
//            echo "<td>" . number_format($tableElement->anno1, 0, ",", ".") . "</td>";
//            echo "<td>" . number_format($tableElement->anno2, 0, ",", ".") . "</td>";
//            echo "<td>" . number_format($tableElement->anno3, 0, ",", ".") . "</td>";
//            echo "</tr>";
//        }
        foreach($tableElements as $tableElement)
        {
            echo "<tr>";
            echo "<td>" . $tableElement->descrizione . "</td>";
            echo "<td>" . $tableElement->totale . "</td>";
            echo "<td>" . $tableElement->anno1 . "</td>";
            echo "<td>" . $tableElement->anno2 . "</td>";
            echo "<td>" . $tableElement->anno3 . "</td>";
            echo "<td>" . $tableElement->cod_provincia . "</td>";
            echo "</tr>";
        }
        
        $conn->close();
        echo "</tbody>";
        echo "</table>";

