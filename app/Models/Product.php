<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Product extends Model
{
    use HasFactory;
    use Commentable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'descripton',
        'price',
        'score',
        'mercadolibre',
        'facebook',
        'yapo',
        'aliexpress',
        'web',
        'others',
        'stock'
    ];

    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }
}
