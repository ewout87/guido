<div class="container">
  <canvas id="myLineChart" height="300"></canvas>
</div>
<script>
  $(document).ready(function(){
              var totaal = <?php echo $totaal; ?>;
              var volwassenen = <?php echo $volwassenen; ?>;
              var kinderen = <?php echo $kinderen; ?>;
              var months = <?php echo $months; ?>;

               var ctx = document.getElementById('myLineChart').getContext('2d');
                Chart.defaults.global.defaultFontFamily = 'Raleway';
                var mixedChart = new Chart(ctx, {

                    // The type of chart we want to create
                    type: 'bar',

                    // The data for our dataset
                    data: {
                        datasets: [{
                            label: "volwassenen",
                            backgroundColor: '#50d0ff',
                            data: volwassenen
                        },{
                            label: "kinderen",
                            backgroundColor: '#7f50ff',
                            data: kinderen
                        },{ 
                            label: "totaal",
                            borderColor: '#ff7f50',
                            data: totaal,
                          
                          type: 'line'
                          
                        }],
                      labels: months,
                    },
                    // Configuration options go here
                    options: {
                      scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                      },
                      legend:{
                        position: 'bottom',
                      }
                    }
                    
                });
            }
        );
</script>