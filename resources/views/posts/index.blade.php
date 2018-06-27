  <div class="card">
    <div class="card-header">
      <h3><i class="fas fa-thumbtack"></i></i> Message Board 
        
      </h3>
    </div>
    <div class="card-body">
      @include ('posts.create')
      <hr>
      @if(count($posts)>0)
      @foreach($posts as $post)
       <div class="alert alert-secondary">
        <div class="row">
          <div class="col-md-2">
            <img class="rounded-circle" src="/guido/public/storage/avatars/{{$post->user->avatar}}" alt="{{$post->user->avatar}}" width="50" height="50">
          </div>
          <div class="col-md-10">
            <p>{{$post->body}}</p>
            <p>
            <small style="float: right">posted by {{$post->user->name}} on {{$post->created_at}}</small>
            </p>
          </div>
         </div>
       </div>
      @endforeach
      </ul>
      @else
      <p>Geen berichten gevonden</p>
      @endif
    </div> 
    <div class="card-footer pagination justify-content-end">
      {{$posts->links()}}
    </div>
  </div>  