<div>
    {{-- Do your work, then step back. --}}
    <div class="active mb-4">
        <input class="form-control border-primary border" wire:model="search" type="text" placeholder="Search"
            aria-label="Search">
        <div class="list-group">
            @foreach ($payments as $pay)
                <a href="#" class="list-group-item list-group-item-action ">
                    Cras justo odio
                </a>
            @endforeach
            {{ $payments->links() }}
        </div>
    </div>
</div>
