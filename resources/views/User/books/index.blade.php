<x-app-layout>
	here you can see your added to a list books

<div class="container">
  <div class="row">
  	<div class="col-2">
      One of three columns
    </div>
    <div class="col-7">
      <table class="table table-primary table-striped">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">confirmed</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>edit, delete</td>
    </tr>
   </tbody>
</table>
    </div>
    <div class="col-3">
      <a href="{{route('user.books.create')}}">Add a new book to the list</a>
    </div>
  </div>
</div>
	







</x-app-layout>