<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Currency List API
     * @group Currencies
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        $currencies = CurrencyResource::collection($currencies);
        return sendResponse($currencies, 'Currencies listed successfully.');
    }

    /**
     * Get Currency API
     * @group Currencies
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::find($id);
        if(!empty($currency)) {
            $currency = new CurrencyResource($currency);
            return sendResponse($currency, 'Currency fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }
}
