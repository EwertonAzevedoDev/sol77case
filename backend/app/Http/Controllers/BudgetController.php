<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\GeocodingService;
use App\Services\BudgetService;

class BudgetController extends Controller
{
     /**
     * Instantiate a new BudgetController instance.
     *
     * @return void
     */
    public function __construct(GeocodingService $geocodingService, BudgetService $budgetService)
    {
        $this->middleware('auth');
        $this->geocodingService = $geocodingService;
        $this->budgetService = $budgetService;
    }

    /**
     * Get the authenticated User.
     *
     * @param  Request  $request
     * @return Response
     */
    public function budget(Request $request)
    {
        $this->validate($request, [            
            'cep' => 'required',
            'valor_conta' => 'required',
            'tipo_telhado' => 'required',
        ]);

        try {
            $geocode = $this->geocodingService->getGeocodeFromZipCode($request->input('cep'));
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Error getting geocoding!', 'error' => $e->getMessage()], 409);
        } 

        try {
            $budget = $this->budgetService->getBudget($request->input('valor_conta'),$request->input('tipo_telhado'), $geocode);            
            return response()->json(['budget' => $budget], 200);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Error getting budget!', 'error' => $e->getMessage()], 409);
        } 
        
    
    }

}
