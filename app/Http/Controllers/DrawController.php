<?php

namespace App\Http\Controllers;

use App\Events\UserJoined;
use Illuminate\Http\Request;

class DrawController extends Controller
{
    private $participants = [];

    public function enter(Request $request) {
        $nickname = $request->input('nickname');

        if (in_array($nickname, $this->participants)) {
            return response()->json(['message' => "This nickname is already in the room."], 400);
        }

        $isAdmin = in_array("admin123", $this->participants);

        array_push($this->participants, $nickname);

        broadcast(new UserJoined($nickname, $this->participants));

        return response()->json([
            'message' => $nickname . "joined the room."
        ]);
    }

    public function start() {
        
    }
}
