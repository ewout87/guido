@extends('layouts.app')

@section('content')  
        <div class="col-md-12">
          <div class="container-header">
            <h2>
              <i class="fas fa-users"></i>
              Groepen <a class="btn btn-outline-success pull-right" href="{{url('groups/create')}}">Create</a>
            </h2>
          </div> 
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">
                  Overzicht
              </h3>
            </div>
          <div class="card-body">
            <div class="form-inline">
              {!! Form::open(['action' => 'groupController@search', 'method' => 'GET']) !!}
              {!! Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'zoek...']) !!}
              {!! Form::submit('Zoek',['class'=>'btn btn-outline-default']) !!}
              {!! Form::close() !!}
            </div>
            <br>
            @if(count($groups)>0)
            <div class="table-responsive">
             <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Taal</th>
                    <th>Postcode</th>
                    <th>Aantal</th> 
                    <th>Acties</th> 
                  </tr>
                <thead>
                  
                <tbody>
                  @foreach($groups as $group)
                  <tr>
                    <td>{{$group->naam}}</td>
                    <td>{{$group->email}}</td>
                    <td>{{$group->tel}}</td>
                    <td>{{$group->language->taal}}</td>
                    <td>{{$group->postcode}}</td>
                    <td>{{$group->aantal}}</td>
                    <td>
                      <div class="btn-group">
                        {!! Form::open(['action' => ['groupController@destroy', $group->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          <button type="submit" class="btn btn-outline-danger btn-sm pull-left" data-toggle="confirmation"><i class="fas fa-trash-alt"></i></button>
                        {!! Form::close() !!}
                        <script>
                          $(function () {
                            $('[data-toggle="confirmation"]').confirmation({
                              btnOkLabel: "Ja",
                              btnCancelLabel: "Nee",
                              btnCancelClass: "btn btn-outline-primary",
                              content: "Ben je zeker dat je deze groep wil verwijderen?",
                              title: "Opgepast!"
                            })
                          })
                        </script> 
                        <a href="groups/{{$group->id}}"><button type="submit" class="btn btn-outline-warning btn-sm pull-left"><i class="fas fa-eye"></i></button></a>
                        <a href="groups/{{$group->id}}/edit"><button type="submit" class="btn btn-outline-primary btn-sm pull-left"><i class="fas fa-edit"></i></button></a>
                      </div>
                    </td>
                  </tr>   
                  @endforeach
                </tbody>
              </table>
          </div>
         
        @else
          <p>Geen groepen gevonden</p>
          
        @endif
                 </div>
                 <div class="card-footer pagination justify-content-end">
                {{$groups->links()}}
        </div>
      </div>    
    </div>
  
          
@endsection