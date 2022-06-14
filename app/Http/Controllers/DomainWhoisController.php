<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainWhoisRequest;
use App\Models\DomainWhois;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Iodev\Whois\Factory;

class DomainWhoisController extends Controller
{
    public function DomainWhois(DomainWhoisRequest $request)
    {
        $model = new DomainWhois();
        $model = $model->DomainWhois($request->domain);
        return response()->json($model);
    }
}
