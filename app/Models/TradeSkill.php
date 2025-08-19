<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TradeSkill extends Model
{
    use HasFactory;
    use Commentable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trade_skill';

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
        'user_id',
        'name',
        'lastname',
        'email',
        'trade',
        'phone',
        'whatsapp',
        'address',
        'description',
        'address',
        'facebook',
        'instagram',
        'x',
        'tiktok',
        'qty_comments',
        'score',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}