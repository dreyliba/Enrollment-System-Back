<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    public function index() {
        $track = Track::all();
        return response()->json([
            'code' => 200,
            'tracks' => $track,
        ]);
    }
}
