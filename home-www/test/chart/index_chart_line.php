<html>
   <head>
      <title>Google Charts Tutorial</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
      <script src="/bower/jquery/dist/jquery.min.js"></script>
   </head>
   
   <body>
      <div id="container" style="width: 922px; height: 400px; margin: 0 auto">
      </div>
      <script language="JavaScript">
         function drawChart() {
            
            
    // seasons rp
    var params = {
      act: "currentPlayers",
      shardId: "pc-na", 
      playerId: "account.1c3c1ce572104a168ec83a2b9a7c0832"
    };
    
    $.get("/test/index_chart_line_data.php", params, function(response) {
      
            /*
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Asia', 'Europe'],
               ['2012',  900,      390],
               ['2013',  1000,      400],
               ['2014',  1170,      440],
               ['2015',  1250,       480],
               ['2016',  1530,      540]
            ]);
            */
            
            console.log(response);
            
            var data = new google.visualization.DataTable(response);
            

            var options = {
              tooltip:{isHtml: true, textStyle : {fontSize:12}, showColorCode : true},
              colors: ['#FFD700', '#C0C0C0', '#8C7853'],
              title: 'Population (in millions)',
              colors: ["black", "darkblue"]
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('container'));
            chart.draw(data, options);
      
      
      /*
      $("#chart-seasons-rp").html(""); // spin remove
      
      var viewWindowMax = 2200;
      var viewWindowMin = 1200;
      
      var chart = new google.visualization.ColumnChart(document.getElementById("chart-seasons-rp"));
      var data = new google.visualization.DataTable(response);
      var options = {
        title: response.title,
        titleTextStyle: {
          fontSize: 11
        },
        legend: {
          position: "right"
        },
        chartArea: {
          left: 60,
          right: 140
        },
        colors: ["#00a65a", "#dd4b39", "#f39c12", "#00a65a", "#dd4b39", "#f39c12"],
        vAxis: {
          viewWindowMode: "explicit",
          viewWindow: {
            min: viewWindowMin,
            max: viewWindowMax
          }
        }
      };
      
      chart.draw(data, options);
      */
      
    }, "json").fail(function(xhr) {
      
      console.log(xhr);
    });
            
            
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
   </body>
</html>