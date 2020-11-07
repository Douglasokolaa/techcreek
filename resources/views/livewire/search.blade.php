<div>
    <div class="active mb-4">
        <input class="form-control border-primary border" wire:model="search" type="text" placeholder="Search"
            aria-label="Search">
        <div class="list-group font-weight-bold">
            @foreach ($payments as $pay)
                @php
                if ($logged_in_user->isAdmin()) {
                $link = route('admin.payments.show', $pay->id);
                } else {
                $link = route('frontend.custom.payments.show', $pay->id);
                }
                @endphp
                <a href="{{ $link }}" class="list-group-item list-group-item-action ">
                    {{ $pay->reference }} | {{ $pay->name }} | {{ $pay->product->name }} -
                    [ from {{ $pay->start_dater }} to {{ $pay->end_date }} ]
                </a>
            @endforeach
        </div>
    </div>
</div>
