<?php

namespace App\Jobs;

use App\Models\Apartment;
use App\Models\Article;
use App\Models\StaticPage;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSiteMapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $siteMap = Sitemap::create();
        $site = config("app.website");

        StaticPage::select('name', 'updated_at')->get()->each(function (StaticPage $page) use ($siteMap, $site) {

            switch ($page->name) {
                case 'about':
                    $url = Url::create("$site/about")->setPriority(0.5);
                    break;
                case 'home':
                    $url = Url::create("$site")->setPriority(1.0);
                    break;
                case 'properties':
                    $url = Url::create("$site/properties/istanbul")->setPriority(0.9);
                    break;
                case 'blog':
                    $url = Url::create("$site/{$page->name}")->setPriority(0.7);
                    break;
                case 'contact-us':
                    $url = Url::create("$site/{$page->name}")->setPriority(0.6);
                    break;
                default:
                    $url = Url::create("$site/{$page->name}")->setPriority(0.3);
                    break;
            }

            $url->setChangeFrequency($this->calculateModification($page))
                ->setLastModificationDate($page->updated_at);

            $siteMap->add($url);
        });

        Apartment::select('slug', 'created_at', 'updated_at')->get()
            ->each(function (Apartment $apartment) use ($site, $siteMap) {
                $url = Url::create("$site/properties/istanbul/$apartment->slug");

                if (now()->diffInDays($apartment->created_at) <= 15) {
                    $url->setPriority(0.8);
                } elseif (now()->diffInDays($apartment->created_at) <= 30) {
                    $url->setPriority(0.7);
                } else {
                    $url->setPriority(0.5);
                }

                $url->setChangeFrequency($this->calculateModification($apartment))
                    ->setLastModificationDate($apartment->updated_at);

                $siteMap->add($url);
            });

        Article::select('slug', 'created_at', 'updated_at')->get()
            ->each(function (Article $article) use ($site, $siteMap) {
                $url = Url::create("$site/blog/$article->slug");

                if (now()->diffInDays($article->created_at) <= 15) {
                    $url->setPriority(0.8);
                } elseif (now()->diffInDays($article->created_at) <= 30) {
                    $url->setPriority(0.7);
                } else {
                    $url->setPriority(0.5);
                }

                $url->setChangeFrequency($this->calculateModification($article))
                    ->setLastModificationDate($article->updated_at);

                $siteMap->add($url);
            });

        $siteMap->writeToFile(public_path('sitemap.xml'));
    }

    private function calculateModification(Model $model)
    {
        $diff = now()->diffInHours($model->updated_at);

        if ($diff < 1) {
            return Url::CHANGE_FREQUENCY_ALWAYS;
        } elseif ($diff >= 1 && $diff < 24) {
            return Url::CHANGE_FREQUENCY_HOURLY;
        } elseif ($diff >= 24 && $diff < 168) {
            return Url::CHANGE_FREQUENCY_WEEKLY;
        } elseif ($diff >= 168 && $diff < 720) {
            return Url::CHANGE_FREQUENCY_MONTHLY;
        } elseif ($diff >= 720 && $diff < 8760) {
            return Url::CHANGE_FREQUENCY_YEARLY;
        } else {
            return Url::CHANGE_FREQUENCY_NEVER;
        }
    }
}
