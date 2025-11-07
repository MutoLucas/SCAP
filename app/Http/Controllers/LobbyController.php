<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LobbyController extends Controller
{
    public function lobbyIndex()
    {
        return view('lobby');
    }

    public function viewCopyLine($lineId)
    {
        return view('copyLine',['lineId'=>$lineId]);
    }

    public function viewEditLine($lineId)
    {
        return view('edit-line',['lineId'=>$lineId]);
    }
}
