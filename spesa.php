    <div class="container">
   
        <div class="card">
            <div class="card-body card-padding">
                <div class="btn-demo">
                    <?php include("php/getdata/spesa/header.php"); ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Lista comuni</h2>
            </div>

            <div class="table-responsive">
                <?php 
                    if($_GET["content"] == "ct") //comunitipologia
                        include("php/getdata/spesa/getlistacomuni.php"); 
                    else if($_GET["content"] == "et") //entinonamministrativitipologia
                        include("php/getdata/spesa/getlistanenti.php"); 
                    else if($_GET["content"] == "ept") //entiprovincetipologia
                        include("php/getdata/spesa/getlistaprovince.php");
                    else if($_GET["content"] == "ert") //entiregionitipologia
                        include("php/getdata/spesa/getlistaregioni.php");
                ?>
            </div>
        </div>
    </div>

