<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public static function withToken(User $user): UserResource
    {
        $token = $user->createToken('authToken');
        return self::make($user)->additional([
                'token' => [
                    'access_token' => $token->plainTextToken,
                    'token_type' => 'bearer',
                ],
        ]);
    }
}
