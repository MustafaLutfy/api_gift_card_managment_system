<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CardController;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Auth;

class AdminController extends Controller
{
    public function getAllCards($filter)
    { 
        switch ($filter) {
            case 'all':
                $cards = Card::get();
                return response()->json([
                    
                    "cards" => $cards,
                ]);
                break;
            case 'used':
                $cards = Card::where('is_used', true)->get();
                return response()->json([
                    "cards" => $cards,
                ]);
                break;
            case 'unused':
                $cards = Card::where('is_used', false)->get();
                return response()->json([
                    "cards" => $cards,
                ]);
                break;
            default:
            return response()->json([
                "error" => "Filter value incorrect",
            ]);
                break;
        }
    }
  
    public function viewCard($id)
    {
        $card = Card::where('id', $id)->get()->first();
        return response()->json([
            "card" => $card,
        ]);
    }

    public function viewUserInfo($id)
    {
        $myCards = Card::where('user_id', $id)->get();
        $user = User::where('id', $id)->get()->first();
        return response()->json([
            "balance" => $user->balance,
            "used cards" => $myCards,
        ]);
    }
    

}
