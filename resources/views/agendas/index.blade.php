@extends('layouts.app')

@section('content')  

<div class="col-md-12">
  <div class="container-header">
    <h2>
      <i class="far fa-calendar-check"></i>
      Agenda 
      @if(Auth::user()->role_id===4)
      <a class="btn btn-outline-success pull-right" href="{{url('agendas/create')}}">Create</a>
      @endif
    </h2>
  </div> 
    <div class="card">
             <div class="card-header">
               <h3>
                 Overzicht
                 </h3>
               </div>
               <div class="card-body">
                 @include('agendas.errors')
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <tbody> 
                         <tr><h4>Deze week</h4></tr>
                            @if(count($thisWeek)>0)
                            <tr>
                              @foreach($thisWeek as $thisWeekDay)
                                <td>
                                  <div class="alert alert-secondary text-center">
                                    <a href="agendas/{{$thisWeekDay->id}}/edit">{{ \Carbon\Carbon::parse($thisWeekDay->datum)->format('l d F')}}</a>
                                      @if (count($thisWeekDay->usersAvailable)>0)
                                      <p>
                                        @foreach($thisWeekDay->usersAvailable as $userAvailable)
                                        <span class="badge badge-pill badge-secondary">{{$userAvailable->name}}</span>
                                        @endforeach
                                      </p>
                                      @else
                                        <p>Geen gids</p>
                                      @endif
                                  </div>
                                </td>
                              @endforeach
                            </tr>
                          @else
                          <tr>
                             <td>Geen agenda items gevonden</td>
                          </tr>
                          @endif
                        </tbody>
                    </table>
                    <table class="table table-hover">
                       <tbody>
                          <tr><h4>Volgende week</h4></tr>
                            @if(count($nextWeek)>0)
                            <tr>
                              @foreach($nextWeek as $nextWeekDay)
                             <td>
                               <div class="alert alert-secondary text-center">
                                <a href="agendas/{{$nextWeekDay->id}}/edit">{{ \Carbon\Carbon::parse($nextWeekDay->datum)->format('l d F')}}</a>
                                 @if (count($nextWeekDay->usersAvailable)>0)
                                  <p>
                                   @foreach($nextWeekDay->usersAvailable as $userAvailable)
                                      <p class="badge badge-pill badge-secondary">{{$userAvailable->name}}</p>
                                   @endforeach
                                  </p>
                                @else
                                  <p>Geen gids</p>
                                @endif
                               </div>
                              </td>
                              @endforeach
                             </tr>
                           @else
                           <tr>
                             <td>Geen agenda items gevonden</td>
                           </tr>
                           @endif
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <tbody>
                          <tr><h4>Komende weken</h4></tr>
                            @if(count($upcomingWeek1)>0)
                            <tr>
                              @foreach($upcomingWeek1 as $upcomingWeek1Day)
                             <td>
                               <div class="alert alert-secondary text-center">
                                 <a href="agendas/{{$upcomingWeekDay->id}}/edit">{{ \Carbon\Carbon::parse($upcomingWeek1Day->datum)->format('l d F')}}</a>
                                 @if (count($nextWeekDay->usersAvailable)>0)
                                   <p>
                                     @foreach($upcomingWeek1Day->usersAvailable as $userAvailable)
                                        <p type="button" class="badge badge-pill badge-secondary">{{$userAvailable->name}}</p>
                                     @endforeach
                                   </p>
                                  @else
                                    <p>Geen gids</p>
                                  @endif
                                </div>
                              </td>
                              @endforeach
                              </tr>
                            @else
                            <tr>
                              <td>Geen agenda items gevonden</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                    </div>
                </div>
                  <div class="card-footer">
                  </div>
                </div>
              </div>
</div>
@endsection