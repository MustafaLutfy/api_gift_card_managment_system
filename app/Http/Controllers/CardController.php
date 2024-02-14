<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CardController;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Http\Requests\CreateCardRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Auth;

class CardController extends Controller
{
 
  
    public function viewCard($id)
    {
        $card = Card::where('id', $id)->get()->first();
        return response()->json([
            "card" => $card,
        ]);
    }
    


    public function store(CreateCardRequest $request)
    {
        $cardData = $request->validated();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $length = 6;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        
        $card = Card::create([
                "serial_number" => $randomString.time(),
                "value" => $cardData->value,
        ]);

        return response()->json([
            "success" => "Card successfully created",
        ]);

    }

   

}
