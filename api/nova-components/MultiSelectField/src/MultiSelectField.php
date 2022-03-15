<?php

namespace DigitalCloud\MultiSelectField;

use Illuminate\Support\Arr;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class MultiSelectField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'multi-select-field';

    public $showOnIndex = false;
    private $translatable = false;
    private $taggable = false;
    protected $relation;

    public function relation($relation)
    {
        $this->relation = $relation;
        return $this;
    }

    public function options($options)
    {
        return $this->withMeta([
            'options' => collect($options ?? [])->map(function ($label, $value) {
                return [
                    'value' => $value,
                    'label' => $label
                ];
            })->values()->all(),
        ]);
    }

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        if ($this->relation) {
            $this->value = $resource->{$this->attribute}->pluck("id")->toArray();
        } elseif ($this->taggable) {
            $this->value = $resource->{$this->attribute} ? json_decode($resource->{$this->attribute}, true) : [];
            $this->setTagsOptions();
        } else {
            $this->value = $resource->{$this->attribute};
        }
    }

    public function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->has("resources"))
            return;

        if ($this->relation) {
            $data = $request->all();
            get_class($model)::saved(function ($model) use ($data, $requestAttribute) {
                $model->{$this->relation}()->sync(Arr::get($data, $requestAttribute, []));
            });
        } elseif ($this->translatable) {
            $model->$attribute = json_encode($request->get($requestAttribute, []));
        } else {
            parent::fillAttributeFromRequest($request, $requestAttribute, $model, $attribute);
        }
    }

    public function get($endpoint)
    {
        $this->withMeta(['endpoint' => $endpoint]);

        return $this;
    }

    public function parent($attribute)
    {
        $this->withMeta(['parent_attribute' => $attribute]);

        return $this;
    }

    public function tagging($value = true)
    {
        $this->taggable = $value;
        $this->withMeta(['tagging' => $value]);

        return $this;
    }

    public function translatable($value = true)
    {
        $this->translatable = $value;

        return $this;
    }

    private function setTagsOptions()
    {
        if ($this->value && is_array($this->value)) {
            $new_array = [];
            foreach ($this->value as $val) {
                $new_array[$val] = $val;
            }
            $this->options($new_array);
        }
    }
}
