<div>
    <form method="POST" action="">

    <input wire:model="message" type="text">

        <button class="btn btn-danger">Submit</button>
        <div class="alert alert-success mt-2 d-none">Successfully saved</div>
    </form>
    <h1>{{ $message }}</h1>

</div>
