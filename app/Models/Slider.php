<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Concerns\HasMediaTrait;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasMediaTrait;
    use HasUploader;

    protected $with = ['media'];

    protected $fillable = [
        'slidertable_id',
        'slidertable_type',
        'stauts',
    ];

    public function scopeActive($query)
    {
        return $query->where('stauts','1');
    }

  
}
