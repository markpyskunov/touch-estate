<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Contact $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'phone' => $model->phone,
            'phone_2' => $model->phone_2,
            'phone_3' => $model->phone_3,
            'email' => $model->email,
            'email_2' => $model->email_2,
            'avatar' => $model->avatar,
        ];
    }
}
