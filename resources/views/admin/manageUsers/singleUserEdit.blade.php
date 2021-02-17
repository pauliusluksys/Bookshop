<x-app-layout>
	here you can edit user information
<div class="container">
  <div class="row">
    <div class="col-sm">
      
    </div>
    <div class="col-sm">
    @if ($errors->any())
    	<div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
      <form method="POST" action="{{url('admin/users/'.$user->id)}}">
      	@csrf
      	@method('PUT')
		  <div class="mb-3">
		    <label for="user_name" class="form-label">User Full Name:</label>
		    <input type="text" class="form-control" id="user_name" name="user_name" value="{{$user->name}}">
		    
		  </div>
		  <div class="mb-3">
		    <label for="user_email" class="form-label">User Email:</label>
		    <input type="email" class="form-control" id="user_email" aria-describedby="author_help" name="user_email" value="{{$user->email}}">
		    
		  </div>
		  
		  
		  <div class="mb-3">
		    <label for="user_password" class="form-label">User New Password:</label>
		    <input type="password" class="form-control" id="user_password" aria-describedby="author_help" name="user_password" value="">
		  </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
	  </form>
    </div>
    <div class="col-sm">
     
    </div>
  </div>
</div>
	


</x-app-layout>