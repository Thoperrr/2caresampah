<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'education_materials';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'url',
        'thumbnail',
        'is_featured',
        'type',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($material) {
            if ($material->isDirty('type')) {
                $material->is_featured = false;
            }
        });
    }

    public function getUrlAttribute($value)
    {
        return $value ?: '#';
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeArticles($query)
    {
        return $query->where('type', 'article');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    public function isArticle()
    {
        return $this->type === 'article';
    }

    public function isVideo()
    {
        return $this->type === 'video';
    }

    public function getYoutubeId()
    {
        if (!$this->url)
            return null;
        if (!str_contains($this->url, 'youtube.com') && !str_contains($this->url, 'youtu.be')) {
            return null;
        }
        if (str_contains($this->url, 'youtu.be/')) {
            $parts = explode('/', rtrim($this->url, '/'));
            return end($parts);
        }
        $parsed = parse_url($this->url, PHP_URL_QUERY);
        if ($parsed) {
            parse_str($parsed, $params);
            return $params['v'] ?? null;
        }
        return null;
    }

    public function getEmbedUrl()
    {
        $youtubeId = $this->getYoutubeId();
        if ($youtubeId) {
            return "https://www.youtube.com/embed/{$youtubeId}?si=67V3WSodL2PwgSKe";
        }
        return null;
    }
}
