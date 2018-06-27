@extends('layouts.app')

@section('content')  
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                  <h2><i class="fas fa-users"></i> Groepen</h2>
                </div> 
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$group->naam}}</h3> 
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                  <li class="list-group-item">{{$group->email}}</li>
                  <li class="list-group-item">{{$group->tel}}</li>
                  <li class="list-group-item">{{$group->language->taal}}</li>
                  <li class="list-group-item">{{$group->postcode}}</li>
                  <li class="list-group-item">{{$group->aantal}}</li>
              </ul>   
              </div>
              <div class="card-footer">
                <a href="{{$group->id}}/edit"><button type="submit" class="btn btn-outline-primary">Update</button></a>
                <a href="{{url('/groups')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
          </div>
    </div>
  </div>
</div>
@endsection