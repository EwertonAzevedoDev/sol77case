<?php

namespace App\Services;

use GuzzleHttp\Client;


class BudgetService
{
    
    public function __construct(){
        $this->base_uri = config('app.sol77_api_base_endpoint');        
        $this->client = new Client;
    }
    /**
     * Get budget data from sol77 api.
     *
     * @return object
     */
    public function getBudget($billing, $roof_type, $geolocation)
    {
          
        $url =  $this->base_uri . $roof_type . '&estado=' . $geolocation->state . 
                '&cidade=' . $geolocation->city . 
                '&valor_conta=' . $billing . 
                '&cep=' . $geolocation->postal_code . 
                '&latitude=' . $geolocation->lat .
                '&longitude=' . $geolocation->lng;   
                 
        $res = $this->client->request('GET' , $url);        
        
        return json_decode($res->getBody());
    }
}