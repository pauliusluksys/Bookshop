<x-app-layout>
	<div class="container">
		<div class="row">
			<div class="col-2">
				
			</div>
			<div class="col-8">
				<h5>
					User Full Name: {{$user->name}}<br>
					User Email: {{$user->email}}<br>
					Edit User: 

					
					<a class="btn btn-primary" href="{{url('admin/users/'.$user->id.'/edit')}}" role="button">Edit</a>
					<form method="POST" action="{{url('admin/users/'.$user->id)}}" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
					
				</h5>
			</div>
			<div class="col-2">
				
			</div>


		</x-app-layout>