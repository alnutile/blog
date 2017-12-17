<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GenerateCodeName;

class CodenameController extends Controller
{
    public function show()
    {
        return view("codenames.show");
    }

    public function process(Request $request, GenerateCodeName $generate)
    {
        $codename = $generate->getName();
        return \response($codename);
    }
}
