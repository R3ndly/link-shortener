<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ProfileController
{
    protected $userData;

    public function __construct()
    {
        $this->userData = auth()->user();
    }

    public function getProfileData(): JsonResponse
    {
        return response()->json([
            'email' => $this->userData->email,
            'gender_name' => $this->userData->gender->gender_name
        ]);
    }
}
