    $(document).ready(function()
    {
    
        /* Make some random data for Recent Items chart */
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
            });
            return vars;
        }
        $.ajax({
            url: 'js/flot-charts/php/getripartizionedata.php?cod_rip=' + getUrlVars()["cod_rip"],
            type: 'get',
            success: function(data) {
                
                var data2 = [];
                var d1 = [];

                json = JSON.parse(data);
                for (var i = 0; i < json.length; i++)
                {
                    data2.push([i, parseInt(json[i].totale), json[i].date]);
                }
            
                var data = [];
                var totalPoints = 100;
                var updateInterval = 30;
                //console.log(data2);
                
                var d2 = [];
                for (var i = 0; i <= 20; i += 1) {
                    d2.push([i, parseInt(Math.random() * 30)]);
                }    
                var d3 = [];
                for (var i = 0; i <= 10; i += 1) {
                    d3.push([i, parseInt(Math.random() * 30)]);
                }
                //console.log(d1);
                /* Chart Options */
    
                var options = {
                    series: {
                        shadowSize: 0,
                        lines: {
                            show: false,
                            lineWidth: 0,
                        },
                        points: {
                                radius: 3,
                                fill: true,
                                show: true
                            }
                    },
                    grid: {
                        borderWidth: 0,
                        labelMargin:10,
                        hoverable: true,
                        clickable: true,
                        mouseActiveRadius:6,

                    },
                    xaxis: {
                        tickDecimals: 0,
                        ticks: false
                    },

                    yaxis: {
                        tickDecimals: 0,
                        ticks: false
                    },

                    legend: {
                        show: false
                    }
                };
    
                /* Regular Line Chart */
                if ($("#line-chart-ripartizione")[0]) {
                    $.plot($("#line-chart-ripartizione"), [
    //                    {data: data2, lines: { show: true, fill: 0.98 }, label: 'Product 1', stack: true, color: '#e3e3e3' },
                        {data: data2, lines: { show: true, fill: 0.98 }, label: 'Product 2', stack: true, color: '#FFC107' }
                    ], options);
                }
            
            if ($(".flot-chart")[0])
            {
                $(".flot-chart").bind("plothover", function (event, pos, item) {
                    if (item)
                    {
                        //console.log(item);
                        var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2)
                            z = item.datapoint[2];
                        $(".flot-tooltip").html(item.series.label + " of " + x + " = " + y + " / " + item.series.data[item.dataIndex][2]).css({top: item.pageY+5, left: item.pageX+5}).show();
                    }
                    else
                    {
                        $(".flot-tooltip").hide();
                    }
                });

                $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body");
            }
        }
    });
});


