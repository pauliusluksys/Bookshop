<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      You can manage Users here!
    </h2>
  </x-slot>
@if ($message = Session::get('success'))
<div class="alert alert-success"  role="alert">
<p>{{ $message }}</p>
</div>
@endif
<div class="container">
  <div class="row">
  	<div class="col-2">
      
    </div>
    <div class="col-7">
      <table class="table table-primary table-striped">
  <thead>
    
    <tr>
      <th scope="col">Nr</th>
      <th scope="col">User</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
  	@php
    $i = 1;
	@endphp
  	@foreach($users as $user)

    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td><a href="{{url('admin/users/' . $user->id)}}">-></a></td>
    </tr>
   </tbody>
   @endforeach
</table>
    </div>
    <div class="col-3">
      
    </div>
  </div>
</div>



</x-app-layout>
