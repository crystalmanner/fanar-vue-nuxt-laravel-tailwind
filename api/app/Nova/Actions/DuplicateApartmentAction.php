<?php

namespace App\Nova\Actions;

use App\Models\Apartment;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class DuplicateApartmentAction extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = "Duplicate";

    private $lastId;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /**
         * @var Apartment $apartment
         * @var Apartment $apartment
         * @var Model $item
         */
        DB::transaction(function () use ($models) {
            $models->load(['views', 'deliverables', 'transports', 'offers', 'landmarks', 'tags'])
                ->each(function ($model) {
                    $newModel = $model->replicate();
                    $newModel->code = $model->code . "-replicated";
                    $newModel->slug = $model->slug . "-replicated";
                    $newModel->push();
                    $this->lastId = $newModel->id;

                    collect($model->getRelations())
                        ->each(function (\Illuminate\Database\Eloquent\Collection $items, $relation) use ($model, $newModel) {
                            if ($model->$relation() instanceof BelongsToMany) {
                                $newModel->$relation()->saveMany($items);
                            } elseif ($model->$relation() instanceof HasMany) {
                                $newModel->$relation()->createMany($items->except(['id', $model->project()->getForeignKeyName(), 'created_at', 'updated_at', 'deleted_at'])->toArray());
                            }
                        });
                });
        });
//
//        if ($models->count() === 1) {
//            return Action::redirect(config('nova.url') . config('nova.path') . '/resources/apartments/' . $this->lastId);
//        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
        ];
    }
}
