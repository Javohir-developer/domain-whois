<?php

namespace App\Models;
use Exception;
use Iodev\Whois\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainWhois extends Model
{
    use HasFactory;
    protected $fillable = ['domain'];
    public function DomainWhois($domain){
        $whois = Factory::get()->createWhois();
        $info = $whois->loadDomainInfo($domain);
        return $info;
    }
}
