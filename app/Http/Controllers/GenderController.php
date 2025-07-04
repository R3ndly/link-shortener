<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index(): JsonResponse
    {
        $genders = Gender::all();

        return response()->json($genders);
    }
}
