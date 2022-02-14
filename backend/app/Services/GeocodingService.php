<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodingService
{
    
    public function __construct(){
        $this->base_uri = config('app.geocoding_api_base_endpoint');
        $this->api_key = config('app.geocoding_api_key');
        $this->client = new Client;
    }
    /**
     * Get geocoding data from google api.
     *
     * @return object
     */
    public function getGeocodeFromZipCode(String $postal_code)
    {
        $data = (object) Array();   
        $res = $this->client->request('GET', $this->base_uri . $postal_code . '&key=' . $this->api_key);
        $address = json_decode($res->getBody())->results[0]->address_components;
        $geometry = json_decode($res->getBody())->results[0]->geometry->location;
        $data->lat = number_format($geometry->lat, 1);
        $data->lng = number_format($geometry->lng, 1);        
        foreach ($address as $key => $value) {
            if(in_array("administrative_area_level_2",$value->types)){
                $data->city = $value->short_name;
            }elseif(in_array("administrative_area_level_1",$value->types)){
                $data->state = $value->short_name;
            }elseif(in_array("postal_code",$value->types)){
                $data->postal_code = $value->short_name;
            };
        }   
        
        return $data;
    }
}