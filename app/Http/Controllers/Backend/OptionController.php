<?php

namespace App\Http\Controllers\Backend;


use App\Models\Option;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;

class OptionController extends BackendController
{

    const OP_HOME_PROJECTS = 'home_projects';
    const OP_HOME_POSTS = 'home_posts';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homeProjectConfig() {
        $projects = Project::active()->get(['title', 'id'])->pluck('title', 'id');
        $homeProjects = option(Option::HOME_PROJECTS, []);
        $homeProjects = collect($homeProjects)
            ->sortBy('sort', SORT_NUMERIC);
        $this->setPageData('Cài đặt công trình trên trang chủ');
        return view('backend.pages.home.projects', $this->getViewData(['projects' => $projects, 'homeProjects' => $homeProjects]));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homePostConfig() {
        $posts = Post::active()->get(['title', 'id'])->pluck('title', 'id');
        $optionData = option(Option::HOME_POSTS, []);
        $optionData = collect($optionData)->sortBy('sort', SORT_NUMERIC);

        $this->setPageData('Cài đặt ti tức trên trang chủ');

        return view('backend.pages.home.posts', $this->getViewData(['posts' => $posts, 'homePosts' => $optionData]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function homeProjectAdd(Request $request) {
        $project = Project::query()->findOrFail($request->id, ['id', 'title']);

        return $this->homeAddItem(Option::HOME_PROJECTS, $project->id, $project->title);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function homePostAdd(Request $request) {
        $project = Post::query()->findOrFail($request->id, ['id', 'title']);

        return $this->homeAddItem(Option::HOME_POSTS, $project->id, $project->title);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function homeProjectDel($id) {
        return $this->homeDelItem(Option::HOME_PROJECTS, $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function homePostDel($id) {
        return $this->homeDelItem(Option::HOME_POSTS, $id);
    }

    /**
     * @param $key
     * @param $id
     * @param $title
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function homeAddItem($key, $id, $title) {
        $optionData = option($key, []);
        $optionData[$id] = ['id' => $id, 'title' => $title, 'sort' => 1000];
        $optionData = collect($optionData)->sortBy('sort', SORT_NUMERIC)->toArray();
        option([$key => $optionData]);
        return back()->with('success', 'Thêm ok!');
    }

    /**
     * @param $key
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function homeDelItem($key, $id) {
        $optionData = option($key, []);
        unset($optionData[$id]);
        $optionData = collect($optionData)->sortBy('sort', SORT_NUMERIC)->toArray();
        option([$key => $optionData]);
        return back()->with('success', 'Xóa ok!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function options() {

        $options = Option::all()->pluck('value', 'key');

        $defaultOptions = config('options', []);

        $this->setPageData('Thiết lập trang');

        return view('backend.pages.option.index', $this->getViewData(['defaultOptions' => $defaultOptions, 'options' => $options]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOptions(Request $request) {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (config('options.' . $key, false)) {
                option([$key => $value]);
            }
        }

        return back()->with('success', 'Cập nhật ok!');
    }
}
