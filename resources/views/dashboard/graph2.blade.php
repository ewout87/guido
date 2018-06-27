<div class="container">
    <canvas id="myDoughnutChart" height="200"></canvas>
</div>
<script>
  $(document).ready(
      function()
      {
          var productsLastMonth = <?php echo $productsLastMonth; ?>;
          var toursLastMonthByProduct = <?php echo $toursLastMonthByProduct; ?>;

         var ctx = document.getElementById('myDoughnutChart').getContext('2d');
          Chart.defaults.global.defaultFontFamily = 'Raleway';
          var chart = new Chart(ctx, {
              // The type of chart we want to create
              type: 'doughnut',

              // The data for our dataset
              data: {
                  labels: productsLastMonth,
                  datasets: [{
                      label: "Gelopen rondleidingen",
                      backgroundColor: ['#ffd750', '#ff5079'],
                      
                      data: toursLastMonthByProduct,
                  }]
              },

              // Configuration options go here
              options: {
                cutoutPercentage: 60,
                legend:{
                  position: 'bottom',
                }
              }
          });
      }
  );
</script>