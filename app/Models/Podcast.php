<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{

    protected $primaryKey = 'id';

    protected $table = 'users';

    /**
     * @var Carbon $created_at
     */
    protected Carbon $created_at;

    /**
     * @var Carbon $updated_at
     */
    protected Carbon $updated_at;

}
