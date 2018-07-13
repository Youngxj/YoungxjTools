/**
 * Unicorn Admin Template
 * Version 2.2.0
 * Diablo9983 -> diablo9983@gmail.com
**/

$(document).ready(function(){
	

	// === Prepare sparklines charts === //
	unicorn.sparkline();
	
	// === Prepare the chart data ===/
	var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }

	// === Make chart === //
    var plot = $.plot($(".chart"),
           [ { data: sin, label: "sin(x)", color: "#4fabd2"}, { data: cos, label: "cos(x)",color: "#459D1C" } ], {
               series: {
                   lines: { show: true },
                   points: { show: true }
               },
               legend: { backgroundOpacity: 0.5 },
               grid: { hoverable: true, clickable: true, borderColor: "#eeeeee", borderWidth: 1, color: "#AAAAAA" },
               yaxis: { min: -1.6, max: 1.6 }
		   });
    
	// === Point hover in chart === //
    var previousPoint = null;
    $(".chart").bind("plothover", function (event, pos, item) {
		
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                
                $('#tooltip').fadeOut(200,function(){
					$(this).remove();
				});
                var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
                    
                unicorn.flot_tooltip(item.pageX, item.pageY,item.series.label + " of " + x + " = " + y);
            }
            
        } else {
			$('#tooltip').fadeOut(200,function(){
					$(this).remove();
				});
            previousPoint = null;           
        }   
    });	
    
    // === Calendar === //    
    var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$('.calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		events: [
			{
				title: 'All day event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long event',
				start: new Date(y, m, 5),
				end: new Date(y, m, 8)
			},
			{
				id: 999,
				title: 'Repeating event',
				start: new Date(y, m, 2, 16, 0),
				end: new Date(y, m, 3, 18, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating event',
				start: new Date(y, m, 9, 16, 0),
				end: new Date(y, m, 10, 18, 0),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, 14, 12, 0),
				end: new Date(y, m, 15, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday PARTY',
				start: new Date(y, m, 18),
				end: new Date(y, m, 20),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 27),
				end: new Date(y, m, 29),
				url: 'http://www.google.com'
			}
		]
	});


});


unicorn = {
		// === Peity charts === //
		sparkline: function(){		
			$(".sparkline_line_good span").sparkline("html", {
				type: "line",
				fillColor: "#B1FFA9",
				lineColor: "#459D1C",
				width: "50",
				height: "24"
			});
			$(".sparkline_line_bad span").sparkline("html", {
				type: "line",
				fillColor: "#FFC4C7",
				lineColor: "#BA1E20",
				width: "50",
				height: "24"
			});	
			$(".sparkline_line_neutral span").sparkline("html", {
				type: "line",
				fillColor: "#CCCCCC",
				lineColor: "#757575",
				width: "50",
				height: "24"
			});
			
			$(".sparkline_bar_good span").sparkline('html',{
				type: "bar",
				barColor: "#83bd67",
				barWidth: "5",
				height: "24"
			});
			$(".sparkline_bar_bad span").sparkline('html',{
				type: "bar",
				barColor: "#55acd2",
				barWidth: "5",
				height: "24"
			});	
			$(".sparkline_bar_neutral span").sparkline('html',{
				type: "bar",
				barColor: "#757575",
				barWidth: "5",
				height: "24"
			});
		},

		// === Tooltip for flot charts === //
		flot_tooltip: function(x, y, contents) {
			
			$('<div id="tooltip">' + contents + '</div>').css( {
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
}
