<?php

namespace App\Http\Controllers;

use App\Models\Module;

class KbPageController extends Controller
{
    /**
     * Хаб: список опубликованных страниц, сгруппированных по group_name.
     */
    public function home()
    {
        $pages = Module::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('kb.index', [
            'pages' => $pages,
            'pagesByGroup' => $pages->groupBy('group_name'),
        ]);
    }

    /**
     * Отдельная KB-страница по slug.
     * Slug -> модуль -> рендерим Blade-вью, указанный в поле `file`.
     */
    public function show(string $slug)
    {
        $module = Module::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->first();

        abort_unless($module, 404);
        abort_unless(view()->exists($module->file), 404);

        return view($module->file, [
            'currentPage' => $module,
        ]);
    }
}
