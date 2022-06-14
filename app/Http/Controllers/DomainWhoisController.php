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
        $text =  '<p>domainName: '.$model->domainName.'</p>';
        $text .=  '<p>parserType: '.$model->parserType.'</p>';
        $text .=  '<p>whoisServer: '.$model->whoisServer.'</p>';
        $text .=  '<p>creationDate: '.$model->creationDate.'</p>';
        $text .=  '<p>expirationDate: '.$model->expirationDate.'</p>';
        $text .=  '<p>updatedDate: '.$model->updatedDate.'</p>';
        $text .=  '<p>owner: '.$model->owner.'</p>';
        $text .=  '<p>registrar: '.$model->registrar.'</p>';
        $text .=  '<p>dnssec: '.$model->dnssec.'</p>';
        return $text;
    }
}
