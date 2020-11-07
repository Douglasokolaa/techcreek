<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Custom\Models\Product;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class PaymentTable.
 */
class ProductTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Product::where('is_active', true)->withCount('payments');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('S/N'), 'id')
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Price Daily'), 'daily_price')
                ->searchable()
                ->sortable()
                ->format(function (Product $model) {
                    return 'NGN ' . $model->daily_price;
                }),
            Column::make(__('Price Monthly'), 'monthly_price')
                ->searchable()
                ->sortable()
                ->format(function (Product $model) {
                    return 'NGN ' . $model->monthly_price;
                }),
            Column::make(__('Price Yearly'), 'yearly_price')
                ->searchable()
                ->sortable()
                ->format(function (Product $model) {
                    return 'NGN ' . $model->yearly_price;
                }),
            Column::make(__('Total Payments'),'payments_count')
                ->sortable(),
            Column::make(__('Actions'))
                ->hideIf(!Auth::user()->isAdmin())
                ->format(function (Product $model) {
                    return $this->linkRoute('admin.product.update', __('edit'), ['product' => $model->id], ['class' => 'btn btn-primary']);
                }),
        ];
    }
}
