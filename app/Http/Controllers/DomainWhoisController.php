<?php

namespace App\Http\Controllers;
use Spatie\Browsershot\Browsershot;
use App\Http\Requests\DomainWhoisRequest;
use App\Models\DomainWhois;

class DomainWhoisController extends Controller
{
    public function DomainWhois(DomainWhoisRequest $request)
    {
        $model = new DomainWhois();
        $model = $model->DomainWhois($request->domain);
        if ($model->domainName){
            Browsershot::html($this->HtmlText($model))->save($model->domainName.'.jpeg');
            return response()->json($model);
        }
    }
    public function HtmlText($model){
        $text =  '<p>'.$model->domainName.'</p>';
        $text .=  '<p>'.$model->creationDate.'</p>';
        return $text;
    }
}
