<?php


namespace App\Nova\Fields;


use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class Images extends \Ebess\AdvancedNovaMediaLibrary\Fields\Images
{
    private function fillCustomPropertiesFromRequest(NovaRequest $request, HasMedia $model, string $collection)
    {
        $mediaItems = $model->getMedia($collection);
        $items = request('__media__', [])[$collection] ?? [];

        // do not handle files as custom properties on files are not supported yet
        if ($items instanceof FileBag) {
            return;
        }

        collect($items)
            ->reject(function ($value) {
                return $value instanceof UploadedFile || $value instanceof FileBag;
            })
            ->each(function (int $id, int $index) use ($request, $mediaItems, $collection) {
                if (!$media = $mediaItems->where('id', $id)->first()) {
                    return;
                }


                $this->fillMediaCustomPropertiesFromRequest($request, $media, $index, $collection);
            });
    }

    /**
     * @param \Spatie\MediaLibrary\Models\Media $media
     */
    private function fillMediaCustomPropertiesFromRequest(NovaRequest $request, $media, int $index, string $collection)
    {
        // prevent overriding the custom properties set by other processes like generating convesions
        $media->refresh();

        /** @var Field $field */
        foreach ($this->customPropertiesFields as $field) {
            $requestAttribute = "__media-custom-properties__.{$collection}.{$index}.{$field->attribute}";

            $media->setCustomProperty($field->attribute, request($requestAttribute, ''));
        }

        $media->save();
    }
}
