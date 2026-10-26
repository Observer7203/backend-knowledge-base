<?php

namespace App\Http\Controllers;

use App\Models\Module;

class KbPageController extends Controller
{
    /** Языки, на которых существует база. Первый — основной. */
    public const LOCALES = ['ru', 'en'];

    /**
     * Хаб: список опубликованных страниц, сгруппированных по group_name.
     */
    public function home(string $locale = 'ru')
    {
        $this->applyLocale($locale);

        $pages = Module::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        $view = $this->localisedView('kb.index', $locale);

        return view(view()->exists($view) ? $view : 'kb.index', [
            'pages' => $pages,
            'pagesByGroup' => $pages->groupBy('group_name'),
            'locale' => $locale,
        ]);
    }

    /**
     * Отдельная KB-страница по slug.
     *
     * Для английской версии ищем перевод в kb/en. Если его ещё нет, отдаём
     * русский текст: пустая страница вместо раздела хуже, чем раздел не на том
     * языке, а о подмене сообщает полоса сверху.
     */
    public function show(string $slug, string $locale = 'ru')
    {
        $this->applyLocale($locale);

        $module = Module::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->first();

        abort_unless($module, 404);

        $view = $module->file;
        $translated = true;

        if ($locale !== 'ru') {
            $localised = $this->localisedView($view, $locale);

            if (view()->exists($localised)) {
                $view = $localised;
            } else {
                $translated = false;
            }
        }

        abort_unless(view()->exists($view), 404);

        return view($view, [
            'currentPage' => $module,
            'locale' => $locale,
            'translated' => $translated,
        ]);
    }

    /**
     * kb.KB_3_Laravel -> kb.en.KB_3_Laravel
     */
    private function localisedView(string $view, string $locale): string
    {
        if ($locale === 'ru') {
            return $view;
        }

        $parts = explode('.', $view);
        $name = array_pop($parts);

        return implode('.', [...$parts, $locale, $name]);
    }

    private function applyLocale(string $locale): void
    {
        abort_unless(in_array($locale, self::LOCALES, true), 404);

        app()->setLocale($locale);
    }
}
