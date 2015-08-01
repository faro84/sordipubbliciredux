<?php

    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database= "soldipubblici_notebook";
    
    // Create connection
    $con = new mysqli($host, $username, $password, $database);

    
    //$con = mysqli_connect("localhost","root","root","soldipubblici_notebook") or die("Some error occurred during connection " . mysqli_error($con)); 
    if($_GET["cod_rip"]){
        
        $sql = "SELECT ANNO, PERIODO, TOTALE, TOTALEPERCITTADINO" 
                . " FROM soldipubblici_notebook.ripartizioni_spesatotale_per_mese_per_anno"
                . " WHERE cod_ripartizione = '" . $_GET["cod_rip"] .  "'"
                . " ORDER BY ANNO, PERIODO ASC;";
        $result = $con->query($sql);
        //echo $sql;
        if( !$result)
            die($con->error);
        
        //echo "date,totale" . PHP_EOL;
        
        $resultarray = array();
        $index = 1;
        while($row = $result->fetch_assoc())
        {
            //$date = getTimestamp($row["ANNO"] . "-" . $row["PERIODO"] . "-01");
            //echo $date;
            //$string = $row["ANNO"] . "-" . $row["PERIODO"] . "-01";
            array_push($resultarray, array("date"=>"01-" . $row["PERIODO"] . "-"  .$row["ANNO"],"totale"=>$row["TOTALE"]));
            //array_push($resultarray, array("index"=>($index-1),"totale"=>"21"));
            //$string = "01-" . $row["PERIODO"] . "-"  .$row["ANNO"] . "," . $row["TOTALE"] . PHP_EOL;
            //echo $string;
            
            $index++;
            
            if($index == 13)
                break;
        }
        
    }
    $con->close();
    echo json_encode($resultarray);

