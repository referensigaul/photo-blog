<?php

namespace Core\Services\Photo;

use Core\Services\Photo\Contracts\ThumbnailsGeneratorService as ThumbnailsGeneratorServiceContract;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Lib\ThumbnailsGenerator\Contracts\ThumbnailsGenerator;
use RuntimeException;

/**
 * Class ThumbnailsGeneratorService.
 *
 * @property Storage storage
 * @property ThumbnailsGenerator thumbnailsGenerator
 * @package Core\Services\Photo
 */
class ThumbnailsGeneratorService implements ThumbnailsGeneratorServiceContract
{
    /**
     * ThumbnailsGeneratorService constructor.
     *
     * @param Storage $storage
     * @param ThumbnailsGenerator $thumbnailsGenerator
     */
    public function __construct(Storage $storage, ThumbnailsGenerator $thumbnailsGenerator)
    {
        $this->storage = $storage;
        $this->thumbnailsGenerator = $thumbnailsGenerator;
    }

    /**
     * @inheritdoc
     */
    public function run(...$parameters)
    {
        list($photo) = $parameters;

        if (is_null($photo->path)) {
            throw new RuntimeException('The photo path is not provided.');
        }

        $metaData = $this->thumbnailsGenerator->generateThumbnails(
            $this->storage->getDriver()->getAdapter()->getPathPrefix() . $photo->path
        );

        foreach ($metaData as $metaDataItem) {
            $thumbnailRelPath = pathinfo($photo->path, PATHINFO_DIRNAME) . '/' . pathinfo($metaDataItem['path'], PATHINFO_BASENAME);
            $thumbnails[] = [
                'path' => $thumbnailRelPath,
                'relative_url' => $this->storage->url($thumbnailRelPath),
                'width' => $metaDataItem['width'],
                'height' => $metaDataItem['height'],
            ];
        }

        return $thumbnails ?? [];
    }
}
