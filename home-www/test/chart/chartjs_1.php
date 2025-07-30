<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
    <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
       
.table {
  background-color: #fff;
  margin-bottom: 0;
}

#myChart {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
}
.ingdonut {
    position: relative;
    margin: 0 auto;
    width: 100px;
    height: 100px;
}

.ingdonut .text_red {
    font-family: NanumSquareR;
    position: absolute;
    top: 38px;
    left: 50%;
    width: 40px;
    margin-left: -17px;
    text-align: center;
}


    </style>
  </head>
  <body>
    <h3>Chart.js test</h3>
    
<div class="ingdonut">
  <canvas id="myChart"></canvas>
  <!--<canvas id="myChart" width="100" height="100"></canvas>-->
  <span class="text_red"><span class="text_bold">2</span>%</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      /*labels: ['Red', 'grey'],*/
      datasets: [{
        label: '# of Votes',
        data: [80, 20],
        backgroundColor: [
          'blue',
          'grey'
        ],
      }]
    },
    options: {
      cutout: '70%',
      scales: {
        /*y: {
          beginAtZero: true
        }*/
      }
    }
  });
  
</script>    
  
  
  </body>
</html>



