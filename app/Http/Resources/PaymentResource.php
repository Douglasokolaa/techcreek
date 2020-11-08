<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
            unset(
                $array['id'],
                $array['product_id'],
                $array['created_at'],
                $array['updated_at'],
                $array['product'],
                $array['type'],
                $array['duration'],
            );
            $array['generated_date'] = \Carbon\Carbon::parse($this->updated_at)->toDateTimeLocalString();
            $array['amount']    = $this->amount();
            $array['status']    = $this->status();
            $array['period']    = $this->period();
            $array['product']   = $this->product->name;

        return $array;
    }
}
