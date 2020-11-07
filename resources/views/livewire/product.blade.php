<div>
    <form wire:submit.prevent="save" class="mt-1">
        @include('includes.partials.messages')
        <div class="form-group">
            <label>{{ __('Product Name') }}</label>
            <input type="text" class="form-control" wire:model='name' value="{{ $product->name }}"
                placeholder="product name">
            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="form">{{ __('Price Daily') }}</label>
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">NGN</span>
                </div>
                <input type="text" class="form-control" wire:model='price_daily' value="{{ $product->price_daily }}"
                    placeholder="price perday" aria-label="Amount (to the nearest Naira)>
            <div class=" input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            @error('price_daily') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="form">{{ __('Price Monthly') }}</label>
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">NGN</span>
                </div>
                <input type="text" class="form-control" wire:model='price_monthly' value="{{ $product->price_monthly }}"
                    placeholder="price per Month" aria-label="Amount (to the nearest Naira)>
            <div class=" input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            @error('price_monthly') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="form">{{ __('Price Yearly') }}</label>
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">NGN</span>
                </div>
                <input type="text" class="form-control" wire:model='price_yearly' value="{{ $product->price_yearly }}"
                    placeholder="price per Month" aria-label="Amount (to the nearest Naira)">
                <span class="input-group-text">.00</span>
            </div>
            @error('price_yearly') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-success float-right">Save</button>
    </form>
</div>
