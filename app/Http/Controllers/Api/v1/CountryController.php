<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\CreateRequest;
use App\Http\Requests\Country\EditRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\CountryService;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public $service;
    function __construct(CountryService $countryService)
	{
		$this->service = $countryService;
	}

    /**
     * Country List API
     * @group Countries
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $countries = CountryResource::collection($countries);
        return sendResponse($countries, 'Country listed successfully.');
    }

    /**
     * Add Country API
     * @group Countries
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'country_name' => 'required',
            'dial_code' => 'required',
        ],
        [
            'country_code.required' => 'Please enter country code',
            'country_name.required' => 'Please enter country name',
            'dial_code.required' => 'Please enter dial code',
        ]);
   
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }
        $country = CountryService::createUpdate(new Country, $request);
        $country = new CountryResource($country);
        return sendResponse($country, 'Country added successfully.');
    }

    /**
     * Get Country API
     * @group Countries
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        if(!empty($country)) {
            $country = new CountryResource($country);
            return sendResponse($country, 'Country fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Country API
     * @group Countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'country_name' => 'required',
            'dial_code' => 'required',
        ],
        [
            'country_code.required' => 'Please enter country code',
            'country_name.required' => 'Please enter country name',
            'dial_code.required' => 'Please enter dial code',
        ]);
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }

        $country = Country::find($id);
        if(!empty($country)) 
        {
            $country = CountryService::createUpdate($country, $request);
            $country = new CountryResource($country);
            return sendResponse($country, 'Country updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Country API
     * @group Countries
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if(!empty($country))
        {
            $country->delete();
            $country = new CountryResource($country);
            return sendResponse($country, 'Country deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
