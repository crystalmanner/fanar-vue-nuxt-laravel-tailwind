<?php

namespace App\Nova\Actions;

use App\Models\Media;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use MrMonat\Translatable\Translatable;

class AddMediaMeta extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (Media $media) use ($fields) {
            $media->title = $fields->get('title');
            $media->save();
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Translatable::make('Title')->singleLine()
                ->rules('required', 'max:254'),
        ];
    }
}
