<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;

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

        $data = $request->get("data");
        \Log::debug(var_dump($data));
        \Log::debug("is array " . is_array($data));

        try {
            $converted = json_encode(
                $request->data,
                JSON_UNESCAPED_SLASHES
            );

            return response($converted, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response([], 422);
        }
    }
}
