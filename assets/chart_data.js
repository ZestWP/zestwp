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
	chartOptions = {
		labels: {
			items : [{
				html : mIncVis,
				style : {
					left : '10px',
					top : '10px',
					fontSize : '14px',
					color:'#999'
				}
			},
			{
				html : mIncLead,
				style : {
					left : '10px',
					top : '40px',
					fontSize : '14px',
					color:'#999'
				}
			}]
		},
		chart: {
			type: 'area',
			renderTo: 'high-chart'
		},
		title: {
			text: 'Visitors & Leads'
		},
		yAxis: {	
			
			title: {
				text: 'Numbers'
			},
		},
		xAxis: {	
			categories: xMonth,
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
			name: 'Unique visitors',
			data: mVisitor
		}, {
			name: 'Leads',
			data: mLead
		}],
	
	};
	
	var chart = new Highcharts.Chart(chartOptions);
	
	
	$('#hourly').click(function(){
		$('#chartTabs .tab').removeClass('active');
		$(this).addClass('active');
		if(hVisitor.length > 20 || hLead.length > 20) chartOptions.xAxis.tickInterval = 3;
		else if(hVisitor.length > 15 || hLead.length > 15) chartOptions.xAxis.tickInterval = 2;
		chartOptions.labels.items[0].html= hIncVis;
		chartOptions.labels.items[1].html= hIncLead;
		chartOptions.series[0].data= hVisitor;
		chartOptions.series[1].data= hLead
		chartOptions.xAxis.categories= xHour
		var chart = new Highcharts.Chart(chartOptions);
		
	});
	
	$('#month').click(function(){
		$('#chartTabs .tab').removeClass('active');
		$(this).addClass('active');
		chartOptions.labels.items[0].html= mIncVis;
		chartOptions.labels.items[1].html= mIncLead;
		chartOptions.series[0].data= mVisitor;
		chartOptions.series[1].data= mLead
		chartOptions.xAxis.categories= xMonth
		var chart = new Highcharts.Chart(chartOptions);
		
	});
	
	$('#day').click(function(){
		$('#chartTabs .tab').removeClass('active');
		$(this).addClass('active');
		if(dVisitor.length > 20 || dLead.length > 20) chartOptions.xAxis.tickInterval = 3;
		else if(dVisitor.length > 15 || dLead.length > 15) chartOptions.xAxis.tickInterval = 2;
		chartOptions.labels.items[0].html= dIncVis;
		chartOptions.labels.items[1].html= dIncLead;
		chartOptions.series[0].data= dVisitor;
		chartOptions.series[1].data= dLead
		chartOptions.xAxis.categories= xDay
		var chart = new Highcharts.Chart(chartOptions);
		
	});
	
	$('#year').click(function(){
		$('#chartTabs .tab').removeClass('active');
		$(this).addClass('active');
		chartOptions.labels.items[0].html= yIncVis;
		chartOptions.labels.items[1].html= yIncLead;
		chartOptions.series[0].data= yVisitor;
		chartOptions.series[1].data= yLead
		chartOptions.xAxis.categories= xYear
		var chart = new Highcharts.Chart(chartOptions);
		
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
