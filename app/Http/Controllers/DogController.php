<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import the Http facade

class DogController extends Controller
{
    public function list_breeds()
    {
        //Get request to the Dog CEO API to fetch the list of breeds
        $response = Http::get('https://dog.ceo/api/breeds/list/all');

        //Checks if the response is successful 
        if ($response->successful()) {

            //Extract breed names from the API response
            $breeds = array_keys($response->json()['message']);
            return response()->json(['breeds' => $breeds]);
        }
        
        //Unsuccessful 
        return response()->json(['error' => "Unable to fetch breed list. Please try again later."], 500);
    }

    public function produce_image(Request $request)
    {   
        //For validation, ensures that breed is provided and is a string
        $request->validate([
            'breed' => 'required|string'
        ]);

        //Retrieve the selected breed 
        $breed = $request->input('breed'); 

        //Get request to fetch random image for the given breed 
        $response = Http::get("https://dog.ceo/api/breed/{$breed}/images/random");

        //Checks if the response is successful 
        if ($response->successful()) {

            // Extract the image URL from the API response
            $image_url = $response->json()['message'];
            return response()->json(['image_url' => $image_url]); 
        }

        //Unsuccessful 
        return response()->json(['error' => 'Cannot fetch an image for the selected breed right now'], 500);
    }
}