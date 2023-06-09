<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    
    use Sluggable;
    
    // use SluggableTrait;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::bootSoftDeletes();
    }

    protected $fillable =[
        'title',
        'description',
        'user_id',
        'image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function getHumanReadableDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    protected function image():Attribute
    {
        return Attribute::make(
        get: fn ($value) => asset("storage/". $value)
        );

    }
}
