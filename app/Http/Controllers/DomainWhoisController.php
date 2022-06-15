<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Http\Requests\DomainWhoisRequest;
use App\Models\DomainWhois;

class DomainWhoisController extends Controller
{
    public function DomainWhois(DomainWhoisRequest $request)
    {
        $model = new DomainWhois();
        $model = $model->DomainWhois($request->domain);
        return response()->json($model);
    }

    public function Screenshot(Request $request){
        return Browsershot::url('https://'.$request->domain)->save($request->domain.'.jpeg');
    }

}
