<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $subject_id
 * @property int $predicate_id
 * @property int $object_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Statement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'predicate_id',
        'object_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Resource::class, 'subject_id');
    }

    public function object()
    {
        return $this->belongsTo(Resource::class, 'object_id');
    }

    public function predicate()
    {
        return $this->belongsTo(Predicate::class);
    }
}
