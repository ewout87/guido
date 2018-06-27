@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong><i class="fas fa-exclamation-triangle"></i> Oeps! Dat was niet de bedoeling!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
  <div class="alert alert-success">
    <i class="far fa-thumbs-up"></i>
    {{session('success')}}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-danger">
    <i class="far fa-thumbs-down"></i>
    {{session('error')}}
  </div>
@endif