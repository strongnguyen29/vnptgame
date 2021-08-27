<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

trait HasThumb
{
    use InteractsWithMedia;

    /**
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getThumbAttribute() {
        return $this->getFirstMedia(self::MEDIA_COLLECT);
    }

    /**
     * Dang ky media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECT)
            ->withResponsiveImages()
            ->singleFile();
    }

    /**
     * Set image thumb
     *
     * @param $file
     */
    public function setImage($file) {

        try {
            $this->addMedia($file)
                ->setFileName(sprintf('%s.%s', $this->slug, $file->getClientOriginalExtension()))
                ->toMediaCollection(self::MEDIA_COLLECT);
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            Log::error('setImage post error: ' . $e->getMessage());
        }
    }

    /**
     *
     * @param array $attrs
     * @return \Spatie\MediaLibrary\MediaCollections\HtmlableMedia|\Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getImageHtml(array $attrs = []) {
        $media = $this->getFirstMedia(self::MEDIA_COLLECT);

        return $media ? $media->img('', $attrs) : null;
    }

    /**
     * @return string
     */
    public function getImageUrl() {
        $media = $this->getFirstMedia(self::MEDIA_COLLECT);

        return $media ? $media->getFullUrl() : '';
    }
}
