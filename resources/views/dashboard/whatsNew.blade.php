<div class="card">
    <div class="card-header">
      <h3><i class="far fa-star"></i> What's new?</h3>
    </div>
    <div class="card-body">
      <div class="list-group list-group-flush">
          <li class="list-group-item">
             Rondleidingen
             <span style="float:right">
               @if (count($newTours)>0)
                <span class="badge badge-info badge-pill">{{ count($newTours) }} created</span> 
              @endif
              @if (count($updatedTours)>0)
                <span class="badge badge-info badge-pill">{{count($updatedTours)}} updated</span>
              @endif
            </span>
          </li>
          @if(Auth::user()->role_id===4)
          <li class="list-group-item">
            Gebruikers 
            <span style="float:right">
              @if (count($newUsers)>0)
              <span class="badge badge-info badge-pill">{{ count($newUsers) }} created</span> 
              @endif
              @if (count($updatedUsers)>0)
                <span class="badge badge-info badge-pill"> {{count($updatedUsers)}} updated</span>
              @endif
            </span>
          </li>
          @endif
          @if(Auth::user()->role_id!==3)
          <li class="list-group-item">
            Producten
            <span style="float:right">
              @if (count($newProducts)>0)
                <span class="badge badge-info badge-pill">{{count($newProducts)}} created</span> 
              @endif
              @if (count($updatedProducts)>0)
                <span class="badge badge-info badge-pill">{{count($updatedProducts)}} updated</span>
              @endif
            </span>
          </li>
          <li class="list-group-item">
            Agenda items
            <span style="float:right">
              @if (count($newAgendaItems)>0)
                <span class="badge badge-info badge-pill">{{count($newAgendaItems)}} created</span> 
              @endif
              @if (count($updatedAgendaItems)>0)
                <span class="badge badge-info badge-pill">{{count($updatedAgendaItems)}} updated</span>
              @endif
            </span>
          </li> 
          @endif
          @if(Auth::user()->role_id!==2)
          <li class="list-group-item">
            Groepen
            <span style="float:right">
              @if (count($newGroups)>0)
                <span class="badge badge-info badge-pill">{{count($newGroups)}} created</span> 
              @endif
              @if (count($updatedGroups)>0)
                <span class="badge badge-info badge-pill">{{count($updatedGroups)}} updated</span>
              @endif
            </span>
          </li>
          @endif
    </div>
  </div>
</div>  