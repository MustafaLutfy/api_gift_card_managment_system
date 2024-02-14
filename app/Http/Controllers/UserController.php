<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CardController;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\UseCardRequest;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Auth;

class UserController extends Controller
{
  

    public function myProfile()
    {
        $user = auth()->user();
        $myCards = Card::where('user_id', $user->id)->get();
        return response()->json([
            "balance" => $user->balance,
            "used cards" => $myCards,
        ]);
    }
  
   
    public function useCard(UseCardRequest $request)
    {
        $cardData = $request->validated();
        $card = Card::where('serial_number', $cardData->serial_number)->get()->first();
        $user = auth()->user();
        if(!$card->is_used && $user->cards_used < 3){
            $user->balance = $user->balance + $card->value;
            $user->cards_used = $user->cards_used + 1;
            $card->is_used = 1;
            $card->user_id = auth()->user()->id;
            $card->used_at = date('Y-m-d H:i:s');
            $user->save();
            $card->save();
            return response()->json([
                "success" => $card->value."$"." successfully added to your account",
            ]);
        }
        else{
            return response()->json([
                "error" => "Card is already used or you have reached the limit for today",
            ]);
        }
       
        
    }

  

}
