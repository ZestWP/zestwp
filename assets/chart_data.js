jQuery(document).ready(function($)
{
	setProgress(emailP);
	setcRateProgress(browserP);
	
	function setProgress(progress)
	{			
		var progressBarWidth =progress*$(".procontainer").width()/ 100;  
		$(".progressbar").width(progressBarWidth);
		$(".ORateper").html(progress + "%");
	}
	function setcRateProgress(progress)
	{			
		var progressBarWidth =progress*$(".pro-crate-container").width()/ 100;  
		$(".cprogressbar").width(progressBarWidth);
		$(".cRateper").html(progress + "%");
	}
});

jQuery(document).ready(function($){
	$('#high-chart').highcharts({
		chart: {
			type: 'area'
		},
		title: {
			text: 'Visitors & Leads'
		},
		yAxis: {	
			
			title: {
				text: 'Numbers'
			},
		},
		xAxis: {	categories: xaxis,
			allowDecimals: false,
			labels: {
				formatter: function() {
					return this.value; // clean, unformatted number for year
				}
			}
		},
		tooltip: {
			pointFormat: 'Visited: <b>{point.y:,.0f}</b>'
		},
		plotOptions: {
			area: {
				
				marker: {
					enabled: false,
					symbol: 'circle',
					radius: 2,
					states: {
						hover: {
							enabled: true
						}
					}
				}
			}
		},
		series: [{
			name: 'Visitors',
			data: yaxis
		}, {
			name: 'Leads',
			data: yleads
		}]
	});
	
	
	$(".sents").mambo({percentage: sentP,  label: sents,  displayValue: false,  circleColor: '#92d130',  ringStyle: "full",
	ringBackground: "#f5f5f5",  ringColor: "#ababab",  drawShadow: true });
	$(".fails").mambo({percentage: failP,  label: fails,  displayValue: false,  circleColor: '#bcd130',  ringStyle: "full",
	ringBackground: "#f5f5f5",  ringColor: "#ababab",  drawShadow: true });
	$(".opens").mambo({percentage: emailP,  label: email,  displayValue: false,  circleColor: '#d1a530',  ringStyle: "full",
	ringBackground: "#f5f5f5",  ringColor: "#ababab",  drawShadow: true });
	$(".clicks").mambo({percentage: browserP,  label: browser,  displayValue: false,  circleColor: '#e15f31',  ringStyle: "full",
	ringBackground: "#f5f5f5",  ringColor: "#ababab",  drawShadow: true });
});
