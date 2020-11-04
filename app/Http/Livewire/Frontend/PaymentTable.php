<?php

namespace App\Http\Livewire\Frontend;

// use App\Domains\Auth\Models\User;
use App\Domains\Custom\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class PaymentTable.
 */
class PaymentTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'paid'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Payment::with('product');

        if ($this->status === 'paid') {
            return $query->where('status', Payment::PAID);
        }

        if ($this->status === 'pending') {
            return $query->where('status', Payment::PAID);
        }

        if ($this->status === 'pending') {
            return $query->where('status', Payment::FAILED);
        }
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('S/N'), 'id')
                ->sortable(),
            Column::make(__('Reference'), 'reference')
                ->searchable()
                ->sortable(),
            Column::make(__('Status'), 'status')
                ->sortable()
                ->format(function (Payment $model) {
                    return $this->view('backend.includes.payment.status', ['status' => $model->status]);
                }),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Phone Number'), 'phone_number')
                ->searchable()
                ->sortable()
                ->format(function (Payment $payment) {
                    return $this->link('tel:+' . $payment->phone_number);
                }),
            Column::make(__('Package'), 'product_id')
                ->searchable()
                ->sortable()
                ->format(function (Payment $payment) {
                    return $this->link('tel:+' . $payment->phone_number);
                }),
            Column::make(__('Duration'), 'type')
                ->sortable()
                ->format(function (Payment $pay) {
                    return $pay->type == 'monthly' ? $pay->duration . ' months' : ($pay->type == 'daily' ?  $pay->duration . ' days' : $pay->duration . ' years');
                }),
            Column::make(__('Start'), 'start_date')
                ->sortable(),
            Column::make(__('Expires'), 'end_date')
                ->sortable()
                ->format(function (Payment $pay) {
                    return Carbon::parse($pay->end_date)->calendar();
                }),
            Column::make(__('Actions'))
                // ->hide
                ->format(function (Payment $model) {
                    return '';// view('backend.auth.user.includes.actions', ['user' => $model]);
                }),
        ];
    }
}
