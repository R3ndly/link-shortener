<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function getProfileData()
    {
        $user = auth()->user();

        return response()->json([
            'email' => $user->email,
            'gender_name' => $user->gender->gender_name ?? null
        ]);
    }
}
