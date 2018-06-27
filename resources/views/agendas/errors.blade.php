@if(Auth::user()->role_id===4)
  @if (count($noUsersAvailable)>0)
    <script>
      $(document).ready(function(){
          $("#hideAlertNoUsersAvailable").click(function(){
          $("#alertNoUsersAvailable").slideUp().fadeOut();
        });
        $("#hideAlertNoUsersAvailable").hover(
          function(){
            $(this).css({"opacity": 1, "cursor": "hand"})
          },
          function(){
            $(this).css({"opacity": 0.5, "cursor": "pointer"})
          }
        );
      });
    </script>
    <div id="alertNoUsersAvailable" class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i>
      <strong> {{count($noUsersAvailable)}}</strong>
      @if (count($noUsersAvailable)==1)dag @else dagen @endif zonder beschikbare gids
      <a role="button" id="hideAlertNoUsersAvailable" style="float: right;"><i class="fas fa-times"></i></a>
    </div>
  @endif
@endif