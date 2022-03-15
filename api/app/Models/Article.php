<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property array $title
 * @property string $slug
 * @property array $description
 * @property array $details
 * @property array table_of_content
 * @property array|null $keywords
 * @property string $image
 * @property string $type
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'details', 'keywords', 'table_of_content', 'image_alt', 'seo_keywords'];

    protected $casts = ["keywords" => "array", 'title' => 'array', 'description' => 'array', 'details' => 'array',
        'image_alt' => 'array', 'seo_keywords' => 'array', 'table_of_content' => 'array', 'show_toc' => 'boolean'];

    protected $fillable = ['title', 'description', 'details', "image", "slug", "keywords",
        "type", 'status', 'image_alt', 'seo_keywords', 'table_of_content', 'show_toc'];


    const TYPE_BLOG = 'blog';
    const TYPE_NEWS = 'news';

    const TYPES = [
        'Blog' => self::TYPE_BLOG,
        'News' => self::TYPE_NEWS
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';

    const STATUSES = [
        'Active' => self::STATUS_ACTIVE,
        'Not Active' => self::STATUS_NOT_ACTIVE,
        'show_toc' => false
    ];

    protected $attributes = [
        "status" => self::STATUS_ACTIVE
    ];

    public function getSeo()
    {
        $data = [];

        foreach (Helpers::getSeoTags("title") as $tag) {
            $data[] = Helpers::getTagObj($tag, trans("site.seo_title", ["title" => $this->title]));
        }

        foreach (Helpers::getSeoTags("description") as $tag) {
            $data[] = Helpers::getTagObj($tag, $this->description);
        }

        foreach (Helpers::getSeoTags("image") as $tag) {
            $data[] = Helpers::getTagObj($tag, Storage::url($this->image));
        }

        if ($this->seo_keywords) {
            $data[] = Helpers::getTagObj("keywords", implode(",", is_string($this->seo_keywords) ? json_decode($this->seo_keywords, true) : $this->seo_keywords));
        }

        foreach (Helpers::getSeoTags("url") as $tag) {
            $data[] = Helpers::getTagObj($tag, config('app.website') . "/blog/{$this->slug}");
        }

        foreach (Helpers::getGeneralSeo() as $tag => $value) {
            $data[] = Helpers::getTagObj($tag, $value);
        }

        return $data;
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $model) {
            if ($model->show_toc) {
                $model->generateTableOfContent();
            }
        });
    }

    public function generateTableOfContent()
    {
        $markupFixer = new \TOC\MarkupFixer();
        $tocGenerator = new \TOC\TocGenerator();

        $details = $markupFixer->fix($this->getTranslation("details", "en"));
        $this->setTranslation("table_of_content", "en", $tocGenerator->getHtmlMenu($details, 2, 1));
        $this->setTranslation("details", "en", $details);

        $details = $markupFixer->fix($this->getTranslation("details", "ar"));
        $this->setTranslation("table_of_content", "ar", $tocGenerator->getHtmlMenu($details, 2, 1));
        $this->setTranslation("details", "ar", $details);
    }
}
