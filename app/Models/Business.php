<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory;
    use Commentable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business';

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
        'user_id',
        'score',
        'categories_id',
        'score',
        'qty_comments',
        'keywords',
        'email',
        'email_2',
        'description',
        'address',
        'number',
        'phone',
        'web',
        'facebook',
        'instagram',
        'x',
        'tiktok',
        'mercadolibre',
        'yapo',
        'aliexpress',
        'whatsapp',
        'latitude',
        'longitude',
        'folder',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the products for the business.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
