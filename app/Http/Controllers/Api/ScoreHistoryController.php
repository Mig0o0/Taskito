<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScoreHistory;
use Illuminate\Http\Request;

class ScoreHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "history" => ScoreHistory::where('user_id', auth()->user()->id)
        ];
    }

}
