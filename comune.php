                <div class="container">
                    <div class="card">
  
                        <div class="card-body card-padding">
                            
                            <div class="btn-demo">
                                <?php include("php/header/getheadercomune.php"); ?>
                            </div>
                            
                        </div>
    </div>
    
    <?php include("php/getdata/comune/tabelle_semplici.php"); ?>
<!--                    <div class="block-header">
                        <h2>Data Table</h2>
                        
                        <ul class="actions">
                            <li>
                                <a href="">
                                    <i class="md md-trending-up"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="md md-done-all"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="md md-more-vert"></i>
                                </a>
                                
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                    <li>
                                        <a href="">Manage Widgets</a>
                                    </li>
                                    <li>
                                        <a href="">Widgets Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>-->
                    
                    <div class="card">
                        <div class="card-header">
                            <h2>Basic Example <small>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</small></h2>
                        </div>
                        
                        <div class="table-responsive">
                            <?php include("php/getdata/getspesecomune.php"); ?>
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
                                        <div id="line-chart-comune" class="flot-chart"></div>
                                    </div>
                                </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h2>Basic Example <small>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</small></h2>
                        </div>
                        
                        <div class="table-responsive">
                            <?php include("php/getdata/getenticomune.php"); ?>
                        </div>
                    </div>
                </div>