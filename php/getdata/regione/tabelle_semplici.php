<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $codReg = filter_input (INPUT_GET, 'cod_reg', FILTER_SANITIZE_STRING);
    
    $sql = "SELECT cod_ente FROM soldipubblici_notebook.regioni_spesatotale" .
                " WHERE cod_regione = '" . $codReg . "';";
        //echo $sql;
        $resultEnte = $conn->query($sql);
        if ($resultEnte->num_rows > 0)
        {
            while($rowEnte = $resultEnte->fetch_assoc())
            {
                $codiceEnte = $rowEnte["cod_ente"];
                break;
            }
        }
    
    $sql = "SELECT popolazione, totale, totalepercittadino, posizionetotalespese, posizionetotalespeseperpersona"
            . " FROM soldipubblici_notebook.enti_spesatotale" 
            . " WHERE cod_ente = '" . $codiceEnte . "';";
    //echo $sql;
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $popolazione = $row["popolazione"];
            $spesatotale = $row["totale"];
            $totalepercittadino = round($row["totalepercittadino"]);
            $totaleindex = $row["posizionetotalespese"] + 1;
            $totalepercittadinoindex = $row["posizionetotalespeseperpersona"] + 1;
            break;
        }
    }
    $conn->close();

    //colors: lightgreen, orange, bluegray, teal, red, blue, pink
    //type: chart stats-bar-2, chart stats-line, chart stats-line-2, chart-pie stats-pie, chart stats-bar
    
echo "<div class= \"row\">";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-red\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-bar\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Spesa totale</small>";
echo    "<h2>" . $spesatotale. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-pink\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-bar\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Popolazione</small>";
echo    "<h2>" . $popolazione . "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-green\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-bar\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Totale per cittadino</small>";
echo    "<h2>" . $totalepercittadino. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-cyan\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-line\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Posizione spesa totale per cittadino</small>";
echo    "<h2>" . $totalepercittadinoindex. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-cyan\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-line\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Posizione spesa totale</small>";
echo    "<h2>" . $totaleindex. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-cyan\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-line\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Spesa totale</small>";
echo    "<h2>" . $spesatotale. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-cyan\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-pie\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Spesa totale</small>";
echo    "<h2>" . $spesatotale. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";

echo    "<div class=\"col-sm-3\">";
echo    "<div class=\"mini-charts-item bgm-cyan\">";
echo    "<div class=\"clearfix\">";
echo    "<div class=\"chart stats-pie\"></div>";
echo    "<div class=\"count\">";
echo    "<small>Spesa totale</small>";
echo    "<h2>" . $spesatotale. "</h2>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
echo    "</div>";
                        
echo "</div>";



