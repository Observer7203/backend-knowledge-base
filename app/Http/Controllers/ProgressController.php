<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Topic;
use App\Models\StudySession;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgressController extends Controller
{
    public function modules(): JsonResponse
    {
        $modules = Module::with('topics')->orderBy('sort_order')->get()->map(function ($m) {
            $total = $m->topics->count();
            $done  = $m->topics->where('status', 'done')->count();
            return [
                'id'         => $m->id,
                'title'      => $m->title,
                'file'       => $m->file,
                'total'      => $total,
                'done'       => $done,
                'percent'    => $total > 0 ? round($done / $total * 100) : 0,
                'sort_order' => $m->sort_order,
            ];
        });

        return response()->json(['modules' => $modules]);
    }

    public function topics(string $moduleId): JsonResponse
    {
        $module = Module::with('topics')->findOrFail($moduleId);
        return response()->json([
            'module' => $module->title,
            'topics' => $module->topics,
        ]);
    }

    public function updateTopic(Request $request, int $id): JsonResponse
    {
        $request->validate(['status' => 'required|in:not_started,in_progress,done']);

        $topic = Topic::findOrFail($id);
        $topic->update(['status' => $request->status]);

        return response()->json(['ok' => true, 'topic' => $topic]);
    }

    public function stats(): JsonResponse
    {
        $totalTopics = Topic::count();
        $doneTopics  = Topic::where('status', 'done')->count();
        $inProgress  = Topic::where('status', 'in_progress')->count();

        $sessions     = StudySession::all();
        $totalMinutes = $sessions->sum('duration_minutes');
        $totalDays    = $sessions->groupBy(fn($s) => $s->studied_at->format('Y-m-d'))->count();

        return response()->json([
            'total_topics'    => $totalTopics,
            'done_topics'     => $doneTopics,
            'in_progress'     => $inProgress,
            'percent_done'    => $totalTopics > 0 ? round($doneTopics / $totalTopics * 100) : 0,
            'total_minutes'   => $totalMinutes,
            'total_days'      => $totalDays,
        ]);
    }

    public function logSession(Request $request): JsonResponse
    {
        $request->validate([
            'duration_minutes' => 'required|integer|min:1',
            'module_id'        => 'nullable|string|exists:modules,id',
            'notes'            => 'nullable|string|max:500',
            'studied_at'       => 'nullable|date',
        ]);

        $session = StudySession::create([
            'module_id'        => $request->module_id,
            'duration_minutes' => $request->duration_minutes,
            'notes'            => $request->notes,
            'studied_at'       => $request->studied_at ?? today(),
        ]);

        return response()->json(['ok' => true, 'session' => $session], 201);
    }

    public function getState(): JsonResponse
    {
        $path = storage_path('app/kb-progress.json');
        if (!file_exists($path)) {
            return response()->json((object)[]);
        }
        $decoded = json_decode(file_get_contents($path), true);
        $state = (is_array($decoded) && !array_is_list($decoded)) ? $decoded : (object)[];
        return response()->json($state);
    }

    public function saveState(Request $request): JsonResponse
    {
        $state = $request->all();
        file_put_contents(storage_path('app/kb-progress.json'), json_encode($state));
        return response()->json(['ok' => true]);
    }

    public function seed(): JsonResponse
    {
        if (Module::count() > 0) {
            return response()->json(['ok' => false, 'message' => 'Already seeded']);
        }

        $modules = [
            ['id' => 'kb0',  'title' => 'Программа & Расписание', 'file' => 'Backend_Learning_Program.html', 'sort_order' => 0,  'topics' => ['Roadmap 9 фаз', 'График 16 недель', 'Вопросы собеседования', 'Ресурсы и курсы']],
            ['id' => 'kb1',  'title' => 'PHP Core',                'file' => 'KB_1_PHP_Core.html',          'sort_order' => 1,  'topics' => ['Типы данных', 'ООП базы', 'Классы и объекты', 'Interfaces & Traits', 'Магические методы', 'Namespaces', 'PHP 8.x новшества', 'Closures & Callable', 'Генераторы', 'Обработка ошибок', 'SPL', 'Composer']],
            ['id' => 'kb2',  'title' => 'SQL & Базы данных',       'file' => 'KB_2_SQL_Database.html',      'sort_order' => 2,  'topics' => ['SELECT и JOIN', 'Индексы', 'EXPLAIN', 'Транзакции', 'ACID', 'Нормализация', 'Проектирование БД', 'MySQL vs PostgreSQL', 'PDO']],
            ['id' => 'kb3',  'title' => 'Laravel',                 'file' => 'KB_3_Laravel.html',           'sort_order' => 3,  'topics' => ['Lifecycle', 'Service Container', 'Eloquent', 'N+1 проблема', 'Queues', 'Events', 'Caching', 'Sanctum', 'Gates & Policies', 'Middleware', 'Artisan', 'Testing']],
            ['id' => 'kb4',  'title' => 'Безопасность',            'file' => 'KB_4_Security.html',          'sort_order' => 4,  'topics' => ['Token Rotation', 'OAuth 2.0', 'JWT', 'CSRF', 'XSS', 'SQL Injection', 'CORS', 'Rate Limiting', 'HTTPS/TLS', 'Security Headers']],
            ['id' => 'kb5',  'title' => 'Архитектура & Паттерны',  'file' => 'KB_5_Architecture.html',      'sort_order' => 5,  'topics' => ['SOLID', 'Repository', 'Service Layer', 'Factory', 'Observer', 'Strategy', 'DTO', 'DDD', 'Clean Architecture']],
            ['id' => 'kb6',  'title' => 'Тестирование & DevOps',   'file' => 'KB_6_Testing_DevOps.html',    'sort_order' => 6,  'topics' => ['PHPUnit', 'Unit тесты', 'Feature тесты', 'TDD', 'Pest', 'Docker', 'Docker Compose', 'Git', 'CI/CD', 'Linux', 'Nginx', 'Deploy']],
            ['id' => 'kb7',  'title' => 'SSO / OAuth 2.0 + OIDC',  'file' => 'KB_7_SSO.html',              'sort_order' => 7,  'topics' => ['Authorization Code + PKCE', 'JWT RS256', 'AuthorizationController', 'TokenController', 'JwtService', 'TokenService', 'PkceService', 'UserProvisionController', 'TODO список']],
            ['id' => 'kb8',  'title' => 'MegaRega Интеграция',     'file' => 'KB_8_MegaRega.html',          'sort_order' => 8,  'topics' => ['Flow регистрации', 'Статусы ЛК', 'MegaRegaService', 'MegaRegaApi', 'Events & Listeners', 'Маппинг полей', 'TODO список']],
        ];

        foreach ($modules as $mod) {
            $topics = $mod['topics'];
            unset($mod['topics']);
            $module = Module::create(array_merge($mod, ['total_topics' => count($topics)]));
            foreach ($topics as $i => $title) {
                Topic::create(['module_id' => $module->id, 'title' => $title, 'sort_order' => $i]);
            }
        }

        return response()->json(['ok' => true, 'message' => 'Seeded successfully']);
    }
}
