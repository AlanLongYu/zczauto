<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

class Ziliao extends Model
{
    protected $table = 'ziliaos';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'name',
                            'sort',
                            'slug',
                        ];
}
