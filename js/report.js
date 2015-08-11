function init() {

	$.ajax({
		  url: 'https://www.google.com/jsapi?callback',
		  cache: true,
		  dataType: 'script',
		  success: function(){
			  
		  }
	})
};

function drawChart() {
	$('#pieChartBtn').click(function(){
		
	$.ajax({url :'./application/model/reportEngine.php',
		         type : 'Post',
			     data: {'dao':'getMonthlySalesReport'},
			     dataType : "json",
			      success: function(jsonData)
			      {    
			    	  alert('Hi');
			    	  var arr = new Array();
		               $.each(jsonData, function(key,val){
		            	  arr.push(new Array(key,parseFloat(val)));
		               });
		               var data = new google.visualization.arrayToDataTable(arr,false);
	                   var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
	                   chart.draw(data, {width: 400, height: 240});
			      }
	});
	});
  }
		




function loadPieChart()
{
	google.setOnLoadCallback(drawChart);  	
}