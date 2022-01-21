<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Versione extends Model
{
    protected $table = 'versiones';
    use SoftDeletes;
    protected $fillable = [
        'version',
    ];
}
