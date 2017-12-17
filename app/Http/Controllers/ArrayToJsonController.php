<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayToJsonController extends Controller
{
    public function show()
    {

        return view("a2j.show");
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'data' => 'required'
        ]);

        try {
            $converted = json_decode($request->data, true);

            return response(var_export($converted), 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response([], 422);
        }
    }
}
