<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var User $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'company_id' => $model->company_id,
            'email' => $model->email,
            'address_id' => $model->address_id,
            'contact_id' => $model->contact_id,
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'full_name' => $model->full_name,
            'initials' => $model->initials,
            'company' => new CompanyResource($model->company),
            'address' => new AddressResource($model->address),
            'contact' => new ContactResource($model->contact),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
