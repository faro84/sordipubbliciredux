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
        
        $sql = "SELECT comuni_spesatotale.cod_comune, descrcomune, totale, totalepercittadino,comuni_spesatotale.cod_provincia"
                . " FROM soldipubblici_notebook.comuni_spesatotale"
                . " JOIN soldipubblici_notebook.anagrafe"
                . " ON anagrafe.cod_comune = comuni_spesatotale.cod_comune "
                . " AND anagrafe.cod_provincia = comuni_spesatotale.cod_provincia"
                . " ORDER BY TOTALE DESC"
                . " LIMIT 10;";
        //echo $sql;
        $result = $conn->query($sql);
        $tableElements = array();
        
        class InfoSpesaTotaleComune
        {
            public $comune;
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
                $tableelement = new InfoSpesaTotaleComune();
                $tableelement->totale = round($row["totale"]);
                $tableelement->comune = $row['descrcomune'];
                array_push($tableElements, $tableelement);
                if($tableelement->totale > $max)
                    $max = $tableelement->totale;
                if($index == 0 || $tableelement->totale < $min)
                    $min = $tableelement->totale;
                $index++;
                
                if(strlen($tableelement->comune) > $maxLength)
                    $maxLength = strlen($tableelement->comune);
            }
        }
        
        foreach($tableElements as $tableElement)
        {
            $diff = ($maxLength - strlen($tableElement->comune));
            $emptySpace = "";
//            if($diff > 0)
//            {
//                for ($i = 0; $i <= $diff; $i++)
//                {
//                    $emptySpace = $emptySpace . "&nbsp;";
//                }
//            }
                echo "<div class=\"lv-item\">";
                echo "<div class=\"media\">";
                echo "<div class=\"pull-left-p-relative\">";
                echo "" . $tableElement->comune . $emptySpace . "</i>";
                echo "</div>";
                                                
//                echo "<div class=\"pull-right\">" . $tableElement->totale . "</div>";
                                                
                echo "<div class=\"media-body\">";
                echo "<div class=\"progress\">";
                echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"" . $tableElement->totale . "\" aria-valuemin=\"" . $min
                        . "\" aria-valuemax=\"" . $max . "\" style=\"width: " . (($tableElement->totale / $max ) * 100) . "%\">";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";    
        }
        
        $conn->close();

