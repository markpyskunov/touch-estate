<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var User $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'email' => $model->email,
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'company' => CompanyResource::make($model->company),
            'address' => AddressResource::make($model->address),
            'contact' => ContactResource::make($model->contact),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
