
$(document).ready(function () {
    
    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
    }
    
    var data2 = [];
    
            $.ajax({
            url: 'js/flot-charts/getcomunedata.php?cod_com=' + getUrlVars()["cod_com"] + '&&cod_prov=' + getUrlVars()["cod_prov"],
            type: 'get',
            success: function(data) {
                json = JSON.parse(data);
                for (var i = 0; i < json.length; i++) {
                    data2.push([new Date(json[i].date).getTime(), Number(json[i].totale)]);
                }
//                data2 = JSON.parse(data);
                console.log(data2);
            }
        });
    
/* All data is from www.climatedata.eu */
 
    // Average rainfall
    var d1 = [
        [new Date('2011-01-01').getTime(), 33],
        [new Date('2011-02-01').getTime(), 34],
        [new Date('2011-03-01').getTime(), 23],
        [new Date('2011-04-01').getTime(), 39],
        [new Date('2011-05-01').getTime(), 47],
        [new Date('2011-06-01').getTime(), 26],
        [new Date('2011-07-01').getTime(), 11],
        [new Date('2011-08-01').getTime(), 12],
        [new Date('2011-09-01').getTime(), 24],
        [new Date('2011-10-01').getTime(), 39],
        [new Date('2011-11-01').getTime(), 48],
        [new Date('2011-12-01').getTime(), 48]
    ];
 console.log(d1);
    // Temperature - average highs
    var d2 = [
        [new Date('2011-01-01').getTime(), 11],
        [new Date('2011-02-01').getTime(), 13],
        [new Date('2011-03-01').getTime(), 16],
        [new Date('2011-04-01').getTime(), 18],
        [new Date('2011-05-01').getTime(), 22],
        [new Date('2011-06-01').getTime(), 28],
        [new Date('2011-07-01').getTime(), 33],
        [new Date('2011-08-01').getTime(), 32],
        [new Date('2011-09-01').getTime(), 28],
        [new Date('2011-10-01').getTime(), 21],
        [new Date('2011-11-01').getTime(), 15],
        [new Date('2011-12-01').getTime(), 11]
    ];
 
    // Temperature - average lows
    var d3 = [
        [new Date('2011-01-01').getTime(), 0],
        [new Date('2011-02-01').getTime(), 2],
        [new Date('2011-03-01').getTime(), 3],
        [new Date('2011-04-01').getTime(), 5],
        [new Date('2011-05-01').getTime(), 9],
        [new Date('2011-06-01').getTime(), 13],
        [new Date('2011-07-01').getTime(), 16],
        [new Date('2011-08-01').getTime(), 16],
        [new Date('2011-09-01').getTime(), 13],
        [new Date('2011-10-01').getTime(), 8],
        [new Date('2011-11-01').getTime(), 4],
        [new Date('2011-12-01').getTime(), 2]
    ];
 
    var data = [
        {
            label: "Rainfall",
            data: d1,
            bars: {
                show: true,
                align: "center",
                barWidth: 12*24*60*60*1000,
                fill: true,
                lineWidth: 1
            },
            color: "#478514"
        },
        {
            label: "Temperature - High",
            data: data2,
            lines: {
                show: true,
                fill: false
            },
            points: {
                show: true,
                fillColor: '#AA4643'
            },
            color: '#AA4643',
            yaxis: 2
        },
        {
            label: "Temperature - Low",
            data: d3,
            lines: {
                show: true,
                fill: false
            },
            points: {
                show: true,
                fillColor: '#4572A7'
            },
            color: '#4572A7',
            yaxis: 2
        }
    ];
 
    $.plot($("#line-chart-comune"), data);
//    , {
//        xaxis: {
//            min: (new Date(2010, 11, 15)).getTime(),
//            max: (new Date(2011, 11, 18)).getTime(),
//            mode: "time",
//            timeformat: "%b",
//            tickSize: [1, "month"],
//            monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
//            tickLength: 0, // hide gridlines
//            axisLabel: "Months",
//            axisLabelUseCanvas: true,
//            axisLabelFontSizePixels: 12,
//            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
//            axisLabelPadding: 5
//        },
//        yaxes: [
//            {
//                tickFormatter: function (val, axis) {
//                    return val + "mm";
//                },
//                max: 65,
//                axisLabel: "Rainfall",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
//                axisLabelPadding: 5
//            },
//            {
//                position: 0,
//                tickFormatter: function (val, axis) {
//                    return val + "\u00B0C";
//                },
//                max: 40,
//                axisLabel: "Temperature",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
//                axisLabelPadding: 5
//            }
//        ],
//        grid: {
//            hoverable: true,
//            borderWidth: 1
//        },
//        legend: {
//            labelBoxBorderColor: "none",
//            position: "right"
//        }
//    });
 
//    function showTooltip(x, y, contents, z) {
//        $('<div id="flot-tooltip">' + contents + '</div>').css( {
//            position: 'absolute',
//            display: 'none',
//            top: y - 30,
//            left: x + 30,
//            border: '2px solid',
//            padding: '2px',
//            'background-color': '#FFF',
//            opacity: 0.80,
//            'border-color': z,
//            '-moz-border-radius': '5px',
//            '-webkit-border-radius': '5px',
//            '-khtml-border-radius': '5px',
//            'border-radius': '5px'
//        }).appendTo("body").fadeIn(200);
//    }
 
    function getMonthName(numericMonth) {
        var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var alphaMonth = monthArray[numericMonth];
 
        return alphaMonth;
    }
 
    function convertToDate(timestamp) {
        var newDate = new Date(timestamp);
        var dateString = newDate.getMonth();
        var monthName = getMonthName(dateString);
 
        return monthName;
    }
 
//    var previousPoint = null;
//    var previousPointLabel = null;
// 
//    $("#line-chart-comune").bind("plothover", function (event, pos, item) {
//        if (item) {
//            if ((previousPoint != item.dataIndex) || (previousLabel != item.series.label)) {
//                previousPoint = item.dataIndex;
//                previousLabel = item.series.label;
// 
//                $("#flot-tooltip").remove();
// 
//                if (item.series.label == "Temperature - High") {
//                    var unitLabel = "\u00B0C";
//                } else if (item.series.label == "Temperature - Low") {
//                    var unitLabel = "\u00B0C";
//                } else if (item.series.label == "Rainfall") {
//                    var unitLabel = "mm";
//                }
// 
//                var x = convertToDate(item.datapoint[0]);
//                y = item.datapoint[1];
//                z = item.series.color;
// 
//                showTooltip(item.pageX, item.pageY,
//                        "<b>" + item.series.label + "</b><br /> " + x + " = " + y + unitLabel,
//                        z);
//            }
//        } else {
//            $("#flot-tooltip").remove();
//            previousPoint = null;
//        }
//    });
});
 
 

//        var data1 = [
//            [gd(2013, 1, 1), 1652.21], [gd(2012, 1, 1), 1742.14], [gd(2012, 2, 1), 1673.77], [gd(2012, 3, 1), 1649.69],
//            [gd(2012, 4, 1), 1591.19], [gd(2012, 5, 1), 1598.76], [gd(2012, 6, 1), 1589.90], [gd(2012, 7, 1), 1630.31],
//            [gd(2012, 8, 1), 1744.81], [gd(2012, 9, 1), 1746.58], [gd(2012, 10, 1), 1721.64], [gd(2012, 11, 2), 1684.76]
//        ];
//        
//        var data2 = [];
//        
//        var options = {
//            series: {
//                lines: {
//                    show: true
//                },
//                points: {
//                    radius: 3,
//                    fill: true,
//                    show: true
//                }
//            },
//            xaxis: {
//                mode: "time",
//                tickSize: [1, "month"],
//                tickLength: 1,
//                axisLabel: "2012",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: 'Verdana, Arial',
//                axisLabelPadding: 20
//            },
//            yaxes: {
//                axisLabel: "Gold Price(USD)",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: 'Verdana, Arial',
//                axisLabelPadding: 20,
//                tickFormatter: function (v, axis) {
//                    return v;
//                }
//            },
//            legend: {
//                noColumns: 0,
//                labelBoxBorderColor: "#000000",
//                position: "nw"
//            },
//            grid: {
//                borderWidth: 0,
//                labelMargin:10,
//                hoverable: true,
//                clickable: true,
//                mouseActiveRadius:6,
//            },
//            colors: ["#FF0000", "#0022FF"]
//        };
//
//        function gd(year, month, day) {
//            return new Date(year, month, day).getTime();
//        }
// 
//        var previousPoint = null, previousLabel = null;
//        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
// 
//        $.fn.UseTooltip = function () {
//            $(this).bind("plothover", function (event, pos, item) {
//                if (item) {
//                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
//                        previousPoint = item.dataIndex;
//                        previousLabel = item.series.label;
//                        $("#tooltip").remove();
// 
//                        var x = item.datapoint[0];
//                        var y = item.datapoint[1];
// 
//                        var color = item.series.color;
//                        var month = new Date(x).getMonth();
// 
//                        //console.log(item);
// 
//                        if (item.seriesIndex == 0) {
//                            showTooltip(item.pageX,
//                            item.pageY,
//                            color,
//                            "<strong>" + item.series.label + "</strong><br>" + monthNames[month] + " : <strong>" + y + "</strong>(USD)");
//                        }
//                    }
//                } else {
//                    $("#tooltip").remove();
//                    previousPoint = null;
//                }
//            });
//        };
// 
//        function showTooltip(x, y, color, contents) {
//            $('<div id="tooltip">' + contents + '</div>').css({
//                position: 'absolute',
//                display: 'none',
//                top: y - 40,
//                left: x - 120,
//                border: '2px solid ' + color,
//                padding: '3px',
//                'font-size': '9px',
//                'border-radius': '5px',
//                'background-color': '#fff',
//                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
//                opacity: 0.9
//            }).appendTo("body").fadeIn(200);
//        }
//        
//        $.ajax({
//            url: 'js/flot-charts/getcomunedata.php?cod_com=' + getUrlVars()["cod_com"] + '&&cod_prov=' + getUrlVars()["cod_prov"],
//            type: 'get',
//            success: function(data) {
//                json = JSON.parse(data);
//                for (var i = 0; i < json.length; i++) {
//                    data2.push([new Date(json[i].date).getTime(), Number(json[i].totale)]);
//                }
////                data2 = JSON.parse(data);
//                console.log(data2);
//                console.log(data1);
//            }
//        });
//
//        var dataset = [
//            { label: "Gold Price", data: data2, points: { symbol: "triangle"} }
//        ];

//$(document).ready(function(){
//    if ($("#line-chart-comune")[0]) {
//        $.plot($("#line-chart-comune"), dataset, options);
//        $("#line-chart-comune").UseTooltip();
//    }
//});