@if ($status == \App\Domains\Custom\Models\Payment::PAID)
<span class="badge badge-success">{{ __('Paid') }}</span>
@elseif ($status == \App\Domains\Custom\Models\Payment::PENDING)
<span class="badge badge-warning">{{ __('Paid') }}</span>
@else
<span class="badge badge-danger">{{ __('failed') }}</span>
@endif
