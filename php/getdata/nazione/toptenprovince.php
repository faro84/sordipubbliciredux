<?php
        
        $username = "root"; 
        $password = "root";   
        $host = "localhost";
        $database= "soldipubblici_notebook";

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT province_spesatotale.cod_provincia, descrprovincia, totale, totalepercittadino"
                . " FROM soldipubblici_notebook.province_spesatotale"
                . " JOIN soldipubblici_notebook.anagrafe"
                . " ON anagrafe.cod_provincia = province_spesatotale.cod_provincia "
                . " GROUP BY province_spesatotale.cod_provincia"
                . " ORDER BY totale DESC"
                . " LIMIT 10;";
//        echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        
        class InfoSpesaTotaleProvincia
        {
            public $provincia;
            public $totale;
        }
        
        $max = 0;
        $min = 0;
        $index = 0;
        $maxLength = 0;
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $tableelement = new InfoSpesaTotaleProvincia();
                $tableelement->totale = round($row["totale"]);
                $tableelement->provincia = $row['descrprovincia'];
                array_push($tableElements, $tableelement);
                if($tableelement->totale > $max)
                    $max = $tableelement->totale;
                if($index == 0 || $tableelement->totale < $min)
                    $min = $tableelement->totale;
                $index++;
                
                if(strlen($tableelement->provincia) > $maxLength)
                    $maxLength = strlen($tableelement->provincia);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $diff = ($maxLength - strlen($tableElement->provincia));
            $emptySpace = "";
//            if($diff > 0)
//            {
//                for ($i = 0; $i <= $diff; $i++)
//                {
//                    $emptySpace = $emptySpace . "&nbsp;";
//                }
//            }
                echo "<div class=\"lv-item\">";
                echo "<div class=\"lv-title m-b-5\">";
                //echo "<div class=\"pull-left-p-relative\">";
                echo "" . $tableElement->provincia . $emptySpace . "</i>";
                echo "</div>";
                                                
//                echo "<div class=\"pull-right\">" . $tableElement->totale . "</div>";
                                                
                echo "<div class=\"progress\">";
                echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"" . $tableElement->totale . "\" aria-valuemin=\"" . $min
                        . "\" aria-valuemax=\"" . $max . "\" style=\"width: " . (($tableElement->totale / $max ) * 100) . "%\">";
                echo "</div>";
                echo "</div>";
                echo "</div>";    
        }
        
        $conn->close();

