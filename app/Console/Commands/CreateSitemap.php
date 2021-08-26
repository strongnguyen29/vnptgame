<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class CreateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $map = Sitemap::create()
            ->add(Url::create(url(''))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS)
                ->setPriority(1)
            )
            ->add(Url::create(route('front.about'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
            )
            ->add(Url::create(route('front.contact'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.5)
            );

            $this->createPostsMap($map);

            $map->writeToFile(public_path('sitemap.xml'));

            // Ping google
            Http::get('http://www.google.com/ping?sitemap=' . asset('sitemap.xml'));
    }

    /**
     * @param $map Sitemap
     */
    protected function createPostsMap(&$map) {
        $categories = Category::with('children:id,parent_id,slug')
            ->parentRoot()
            ->type(Category::TYPE_POST)
            ->active()
            ->get(['id', 'slug']);

        foreach ($categories as $cat) {
            $map->add(Url::create(route('front.posts.index', ['rootSlug' => $cat->slug]))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.5));

            foreach ($cat->children as $subCat) {
                $map->add(Url::create(route('front.posts.index', ['rootSlug' => $cat->slug, 'slug' => $subCat->slug]))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.5));
            }
        }

        $posts = Post::active()
            ->latest('updated_at')
            ->get(['id', 'slug', 'updated_at']);

        foreach ($posts as $post) {
            $map->add(Url::create(route('front.posts.detail', ['slug' => $post->slug]))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7));
        }
    }
}
