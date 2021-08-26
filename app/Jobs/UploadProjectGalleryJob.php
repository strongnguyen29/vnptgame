<?php

namespace App\Jobs;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadProjectGalleryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Project
     */
    protected $project;

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var int
     */
    protected $index;

    /**
     * UploadProjectGalleryJob constructor.
     * @param Project $project
     * @param UploadedFile $file
     * @param int $index
     */
    public function __construct(Project $project, UploadedFile $file, $index)
    {
        $this->project = $project;
        $this->file = $file;
        $this->index = $index;
    }


    /**
     * Execute the job.
     *
     * @return void
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function handle()
    {
        $this->project->addMedia($this->file)
            ->setFileName(sprintf('%s-%s.%s', $this->project->slug, $this->index, $this->file->getClientOriginalExtension()))
            ->toMediaCollection(Project::MEDIA_COLLECT_GALLERY);
    }
}
