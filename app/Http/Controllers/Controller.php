<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show()
    {
        $data = []; // Initialize as empty array
        if (Storage::disk('local')->exists('map_data.json')) {
            $jsonData = Storage::disk('local')->get('map_data.json');
            $data = json_decode($jsonData, true) ?? []; // Ensure $data is always an array
        }

        return view('welcome', ['data' => $data]);
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'money' => 'required|integer|min:0',
            'detail' => 'required|string|max:255',
        ]);

        // Retrieve existing data
        $data = [];
        if (Storage::disk('local')->exists('map_data.json')) {
            $jsonData = Storage::disk('local')->get('map_data.json');
            $data = json_decode($jsonData, true) ?? []; // Ensure $data is always an array
        }

        // Add new data
        $data[] = $validated;

        // Store updated data
        Storage::disk('local')->put('map_data.json', json_encode($data));

        return redirect()->back()->with('success', 'Data has been stored successfully!');
    }
}
