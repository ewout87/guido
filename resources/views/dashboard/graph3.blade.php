<div class="container">
  <canvas id="myBarChart" height="200"></canvas>
</div>
<script>
  $(document).ready(
      function()
      {
        var usersLastMonth = <?php echo $usersLastMonth; ?>;
        var toursLastMonthByUser = <?php echo $toursLastMonthByUser; ?>;

         var ctx = document.getElementById('myBarChart').getContext('2d');
          Chart.defaults.global.defaultFontFamily = 'Raleway';
          var chart = new Chart(ctx, {

              // The type of chart we want to create
              type: 'horizontalBar',

              // The data for our dataset
              data: {
                  labels: usersLastMonth,
                  datasets: [{
                      label: "Gelopen rondleidingen" ,
                      backgroundColor: '#50ff7f' ,
                      data: toursLastMonthByUser,
                  }],

              },
              // Configuration options go here
              options: {
                scales: {
                  xAxes: [{
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