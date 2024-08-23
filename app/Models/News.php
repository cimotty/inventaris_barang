<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('judul', 'like', '%'.$search.'%')
                ->orWhere('keterangan', 'like', '%'.$search.'%');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::createUniqueSlug($post->judul);
        });

        static::updating(function ($post) {
            if ($post->isDirty('judul')) {
                $post->slug = static::createUniqueSlug($post->judul, $post->id);
            }
        });
    }

    private static function createUniqueSlug($judul, $id = 0)
    {
        $slug = Str::slug($judul);
        $count = News::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $id)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
