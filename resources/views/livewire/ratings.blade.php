<div>
    <form method="POST" action="">

    <input wire:model.debounce.50ms="message" type="text">

        <button class="btn btn-danger">Submit</button>
        <div class="alert alert-success mt-2 d-none">Successfully saved</div>

    </form>


    <button wire:click="showRateWindow">rate this book</button>
    @if($rateWindowOpen===true)
        Pageseeme
    @else
    @endif
    <h1>{{ $message }}</h1>

</div>
