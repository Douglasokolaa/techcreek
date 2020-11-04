@if ($status == PAYMENT::PAID)
<span class="badge badge-success">{{ __('Paid') }}</span>
@elseif ($status == PAYMENT::PENDING)
<span class="badge badge-warning">{{ __('Paid') }}</span>
@else
<span class="badge badge-danger">{{ __('Paid') }}</span>
@endif
