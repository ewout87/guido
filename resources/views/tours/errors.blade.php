@if(Auth::user()->role_id===4)
    
  @if (count($noUsersAssigned)>0)
    <script>
      $(document).ready(function(){
        $("#hideAlertNoUserAssigned").click(function(){
          $("#alertNoUserAssigned").slideUp().fadeOut();
        });
        $("#hideAlertNoUserAssigned").hover(
          function(){
            $(this).css({"opacity": 1, "cursor": "hand"})
          },
          function(){
            $(this).css({"opacity": 0.5, "cursor": "pointer"})
          }
        );
      });
    </script>
    <div id="alertNoUserAssigned" class="alert alert-danger">
      <i class="fas fa-exclamation-triangle"></i>
      <strong> {{count($noUsersAssigned)}}</strong>
      @if (count($noUsersAssigned)==1) rondleiding heeft @else rondleidingen hebben @endif nog geen gids: 
      <a href="{{ url('/tours/filter/nousersassigned') }}">Toon</a>
      <a id="hideAlertNoUserAssigned" style="float: right;"><i class="fas fa-times"></i></a>
    </div>
  @endif
  @if (count($noStatusClosed)>0)
    <script>
      $(document).ready(function(){
        $("#hideAlertNoStatusClosed").click(function(){
        $("#alertNoStatusClosed").slideUp().fadeOut();
        });
        $("#hideAlertNoStatusClosed").hover(
          function(){
            $(this).css({"opacity": 1, "cursor": "hand"})
          },
          function(){
            $(this).css({"opacity": 0.5, "cursor": "pointer"})
          }
        );
      });
    </script>
    <div id="alertNoStatusClosed" class="alert alert-danger">
      <i class="fas fa-exclamation-triangle"></i>
      <strong> {{count($noStatusClosed)}}</strong>
      @if (count($noStatusClosed)==1) rondleiding is @else rondleidingen zijn @endif nog niet afgesloten: 
      <a href="{{ url('/tours/filter/nostatusclosed') }}">Toon</a>
      <a role="button" id="hideAlertNoStatusClosed" style="float: right;"><i class="fas fa-times"></i></a>
    </div>
  @endif

@endif