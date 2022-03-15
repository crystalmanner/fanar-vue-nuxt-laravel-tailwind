<?php

namespace App\Nova\Actions;

use App\Models\Apartment;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use OwenMelbz\RadioField\RadioButton;

class ShowInHome extends Action
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
        $models->each(function ($model) use ($fields) {
            if ($val = $fields->get('show_in_home')) {
                $model->update(['show_in_home' => $val, "show_at" => now()]);
            } else {
                $model->update(['show_in_home' => null, "show_at" => null]);
            }
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
            RadioButton::make('Show In Home')
                ->options(array_flip(Apartment::SHOW_IN))
                ->default(null)// optional
                ->stack()// optional (required to show hints)
                ->marginBetween()// optional
        ];
    }
}
