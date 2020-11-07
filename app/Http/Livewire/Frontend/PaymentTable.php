<?php

namespace App\Http\Livewire\Frontend;

// use App\Domains\Auth\Models\User;
use App\Domains\Custom\Models\Payment;
use Auth;
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
        return $query;
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
                    return view('backend.includes.payment.status', ['status' => $model->status]);
                }),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Phone Number'), 'phone_number')
                ->searchable()
                ->sortable(),
            Column::make(__('Package'), 'product.name')
                ->searchable()
                ->sortable(),
            Column::make(__('Duration'), 'type')
                ->sortable(),
            Column::make(__('Start'), 'start_date')
                ->sortable(),
            Column::make(__('Expires'), 'end_date')
                ->sortable()
                ->format(function (Payment $model) {
                    return Carbon::parse($model->end_date)->calendar();
                }),
            Column::make(__('Actions'))
                ->format(function (Payment $model) {
                    if (Auth::user()->isAdmin()) {
                        return $this->linkRoute('admin.payments.show','view',['payment' => $model->id],['class' => 'btn btn-primary']);
                    } else {
                        return $this->linkRoute('frontend.custom.payments.show','view',['payment' => $model->id],['class' => 'btn btn-primary']);
                    }
                }),
        ];
    }
}
