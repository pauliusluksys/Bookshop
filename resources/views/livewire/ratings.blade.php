<div>



    <button wire:click="showRateWindow">rate this book</button>

            <div class="container">
                <span id="rateMe1"></span>
            </div>
    <form wire:submit.prevent="saveReview">
        <div class="card-body text-center">

            <fieldset class="rating">
                <h4 class="mt-1">Rate us</h4>
                    <input type="radio" wire:model="rating" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label> <input type="radio" wire:model="rating" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> <input type="radio" wire:model="rating" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label> <input type="radio" wire:model="rating" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> <input type="radio" wire:model="rating" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label> <input type="radio" wire:model="rating" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> <input type="radio" wire:model="rating" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label> <input type="radio" wire:model="rating" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> <input type="radio" wire:model="rating" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label> <input type="radio" wire:model="rating" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> <input type="radio" wire:model="rating" class="reset-option" name="rating" value="reset" />
                {{$rating}}
            </fieldset>
        </div>

        <textarea wire:model="message" id="w3review" rows="4" cols="50">

        </textarea>
        <button class="btn btn-danger">Submit</button>
        <div class="alert alert-success mt-2 d-none">Successfully saved</div>
    </form>
    <h4>Leave a comment:</h4>
            <!-- rating.js file -->
            <script src="js/addons/rating.js"></script>
        @if($rateWindowOpen===true)
        @else
        @endif
    <h1>{{ $message }}</h1>

</div>

