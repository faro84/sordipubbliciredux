
<div class="container">
    <div class="card">
  
                        <div class="card-body card-padding">
                            
                            <div class="btn-demo">
                                <?php include("php/getdata/provincia/header.php"); ?>
                            </div>
                            
                        </div>
    </div>
    
    <?php include("php/getdata/provincia/tabelle_semplici.php"); ?>
    
    <div class="card">
        <div class="card-header">
            <h2>Basic Example <small>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</small></h2>
        </div>
                        
        <div class="table-responsive">
            <?php include("php/getdata/provincia/getspeseente.php"); ?>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h2>Lista comuni <small><a href="index.php?content=listacomuni&&cod_prov=<?php echo $_GET["cod_prov"] ?>">Clicca qui per la lista completa</a></small></h2>
        </div>
                        
        <div class="table-responsive">
            <?php include("php/getdata/provincia/getlistacomuni.php"); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Basic Example <small>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</small></h2>
        </div>
                        
        <div class="table-responsive">
            <?php include("php/getdata/provincia/getspese.php"); ?>
        </div>
    </div>
    
    <div class="card">
                                <div class="card-header">
                                    <h2>Lines Chart <small>Same above example without curved edges.</small></h2>
                                    
                                    <ul class="actions">
                                        <li class="dropdown action-show">
                                            <a href="" data-toggle="dropdown">
                                                <i class="md md-more-vert"></i>
                                            </a>
                            
                                            <div class="dropdown-menu pull-right">
                                                <p class="p-20">
                                                    You can put anything here
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="card-body">
                                    <div class="chart-edge">
                                        <div id="line-chart-provincia" class="flot-chart"></div>
                                    </div>
                                </div>
                    </div>
                    
    <div class="card">
        <div class="card-header">
            <h2>Basic Example <small>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</small></h2>
        </div>
                        
        <div class="table-responsive">
            <?php include("php/getdata/provincia/getenti.php"); ?>
        </div>
    </div>
</div>

