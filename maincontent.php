    <div class="container">
        <div class="card">
            <div class="card-body card-padding">
                <div class="btn-demo">
                    <?php include("php/getdata/overview/header.php"); ?>
                </div>            
            </div>
        </div>
        
        <div class="col-sm-4">
                        <!-- Rating -->
                        <div class="card rating-list">
                            <div class="listview">
                                <div class="lv-header">
                                    <div class="m-t-5">
                                        Average Rating 3.0
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="rl-star">
                                        <i class="md md-star active"></i>
                                        <i class="md md-star active"></i>
                                        <i class="md md-star active"></i>
                                        <i class="md md-star"></i>
                                        <i class="md md-star"></i>
                                    </div>
                                </div>
                                
                                <div class="lv-body">
                                    <div class="p-15">
                                        <?php include("php/getdata/nazione/toptencomuni.php"); ?>                           
                                    </div>
                                </div>
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