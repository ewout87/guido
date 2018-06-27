@extends('layouts.app')

@section('content')      
            <div class="col-md-12">
              <div class="container-header">
                <h2><i class="fas fa-flask"></i> Producten <a href="products/create"><button type="submit" class="btn btn-outline-success">Create</button></a></h2>             
              </div>  
           <div class="row">
              @if(count($products)>0)
             @foreach($products as $product)
             <div class="col-md-6"> 
              <div class="card">
                  <div class="card-header text-center">
                  <span>
                    <h3>
                      {{$product->titel}}
                    <h3>
                  </span>
                 </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">{{$product->beschrijving}}</li>
                    </ul>
                  </div>
                    <div class="col-md-6">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$product->duur}} min</li>
                        <li class="list-group-item">{{$product->max_aantal}} personen</li>
                        <li class="list-group-item">
                              @if ($product->status === 1)
                                  <span class="badge badge-primary">Active</span>
                              @else
                                  <span class="badge badge-secondary">Inactive</span>
                              @endif
                        </li>
                        <li class="list-group-item"><a href="products/{{$product->id}}/download">{{$product->bijlage}}</a></li>
                        <li class="list-group-item">
                          @foreach($product->users as $user)
                          <span type="button" class="badge badge-pill badge-secondary">{{$user->name}}</span>
                          @endforeach
                        </li>
                    </ul>
                  </div>
                </div>
                </div>
                    <div class="card-footer text-center">
                      <div class="btn-group">
                        {!! Form::open(['action' => ['productController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm', 'data-toggle' => 'confirmation'])}}
                        {!! Form::close() !!}
                        <script>
                          $(function () {
                            $('[data-toggle="confirmation"]').confirmation({
                              btnOkLabel: "Ja",
                              btnCancelLabel: "Nee",
                              btnCancelClass: "btn btn-outline-primary",
                              content: "Ben je zeker dat je deze product wil verwijderen?",
                              title: "Opgepast!"
                            })
                          })
                        </script> 
                        <a href="products/{{$product->id}}"><button type="submit" class="btn btn-outline-warning btn-sm pull-left"></i>View</button></a>
                        <a href="products/{{$product->id}}/edit"><button type="submit" class="btn btn-outline-primary btn-sm pull-left"></i>Update</button></a>
                      </div>
                    </div>  
          </div> 
      </div>
        @endforeach
        @else
          <p>Geen producten gevonden</p>
          <div class="nav justify-content-center">  
            {{$users->links()}}
          </div>
        @endif   
      </div>      
    </div>

@endsection