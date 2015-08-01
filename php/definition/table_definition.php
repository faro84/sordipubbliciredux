
    $("#data-table-basic").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    caseSensitive : false,
                    rowNumber: 50,
                    formatters: {
                        "numberFormatterTotale": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "numberFormatterTotale1": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear1).toLocaleString();
                        },
                        "numberFormatterTotale2": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear2).toLocaleString();
                        },
                        "numberFormatterTotale3": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear3).toLocaleString();
                        },
                        "numberFormatterTotaleEnte": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "mylink": function(column, row) {
                            //Console.log(row.totalyear3);
                            //return '<a href="/model/' + row.id + '">' + row.other_parameter + '</a>';
                            return '<a href="index.php?content=ct&&cod_tip=' + row.codice + '">' + row.descrizione + '</a>';
                        }
                    }
                });

    <?php
    
        if(!isset($_GET["content"]) || 
                ($_GET["content"] == "ripartizione" || $_GET["content"] == "regione" || $_GET["content"] == "provincia" || $_GET["content"] == "comune"))
        {
    
    ?>
                
                $("#data-table-lista-comuni-basic").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    caseSensitive : false,
                    //rowCount: 50,
                    formatters: {
                        "numberFormatterTotale": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "numberFormatterTotale1": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear1).toLocaleString();
                        },
                        "numberFormatterTotale2": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear2).toLocaleString();
                        },
                        "numberFormatterTotale3": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear3).toLocaleString();
                        },
                        "numberFormatterTotaleEnte": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "mylink": function(column, row) {
                            //Console.log(row.totalyear3);
                            //return '<a href="/model/' + row.id + '">' + row.other_parameter + '</a>';
                            return '<a href="index.php?content=comune&&cod_com=' + row.codiceComune + '&&cod_prov=' + row.codiceProvincia + '">' + row.descrizione + '</a>';
                        }
                    }
                });
                
                $("#data-table-lista-comuni-completa-basic").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    caseSensitive : false,
                    rowCount: -1,
                    formatters: {
                        "numberFormatterTotale": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "numberFormatterTotale1": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear1).toLocaleString();
                        },
                        "numberFormatterTotale2": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear2).toLocaleString();
                        },
                        "numberFormatterTotale3": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear3).toLocaleString();
                        },
                        "numberFormatterTotaleEnte": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "mylink": function(column, row) {
                            //Console.log(row.totalyear3);
                            //return '<a href="/model/' + row.id + '">' + row.other_parameter + '</a>';
                            return '<a href="index.php?content=comune&&cod_com=' + row.codiceComune + '&&cod_prov=' + row.codiceProvincia + '">' + row.descrizione + '</a>';
                        }
                    }
                });
                
                $("#data-table-lista-enti-basic").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    caseSensitive : false,
                    formatters: {
                        "numberFormatterTotaleEnte": function(column, row) {
                            return parseInt(row.total).toLocaleString();
                        },
                        "mylinkenticomune": function(column, row) {
                            console.log(row.codice);
                            //return '<a href="/model/' + row.id + '">' + row.other_parameter + '</a>';
                            return '<a href="index.php?content=ente&&cod_ente=' + row.codice + '">' + row.descrizione + '</a>';
                        }
                    }
                });
                
                //Selection
                $("#data-table-selection").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    selection: true,
                    multiSelect: true,
                    rowSelect: true,
                    keepSelection: true
                });
                
                //Command Buttons
                $("#data-table-command").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    formatters: {
                        "commands": function(column, row) {
                            return "<button type=\"button\" class=\"btn btn-icon command-edit\" data-row-id=\"" + row.id + "\"><span class=\"md md-edit\"></span></button> " + 
                                "<button type=\"button\" class=\"btn btn-icon command-delete\" data-row-id=\"" + row.id + "\"><span class=\"md md-delete\"></span></button>";
                        }
                    }
                });
    
    <?php
    
        }
        else if(!isset($_GET["content"]) || ($_GET["content"] == "provincia" || $_GET["content"] == "regione"))
        {
            
    ?>
         $("#data-table-ente-basic").bootgrid({
                    css: {
                        icon: 'md icon',
                        iconColumns: 'md-view-module',
                        iconDown: 'md-expand-more',
                        iconRefresh: 'md-refresh',
                        iconUp: 'md-expand-less'
                    },
                    caseSensitive : false,
                    formatters: {
                        "numberFormatterTotale": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "numberFormatterTotale1": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear1).toLocaleString();
                        },
                        "numberFormatterTotale2": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear2).toLocaleString();
                        },
                        "numberFormatterTotale3": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.totalyear3).toLocaleString();
                        },
                        "numberFormatterTotaleEnte": function(column, row) {
                            //Console.log(row.totalyear3);
                            return parseInt(row.total).toLocaleString();
                        },
                        "mylink": function(column, row) {
                            //Console.log(row.totalyear3);
                            //return '<a href="/model/' + row.id + '">' + row.other_parameter + '</a>';
                            return '<a href="index.php?content=ct&&cod_tip=' + row.codice + '">' + row.descrizione + '</a>';
                        }
                    }
                });
                
                
    <?php 

        }
        
    ?>