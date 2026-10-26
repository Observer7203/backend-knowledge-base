<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Поиск по тексту разделов.
 *
 * Названия разделов и подразделов ищет сам браузер по небольшому индексу,
 * который уже загружен. Сюда приходят запросы за тем, что лежит в тексте:
 * три мегабайта в браузер тянуть незачем, поэтому их просматривает сервер.
 *
 * Файл читается построчно — по одной записи JSON на раздел, — так что
 * память не зависит от объёма базы.
 */
class KbSearchController extends Controller
{
    private const CORPUS = 'app/kb-search-text.ndjson';

    /** Сколько результатов отдаём: больше в выпадающий список не влезет. */
    private const LIMIT = 10;

    /** Длина куска текста вокруг найденного слова. */
    private const SNIPPET = 150;

    public function __invoke(Request $request): JsonResponse
    {
        $query = $this->normalize((string) $request->query('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        // несколько слов — требуем все, иначе запрос из двух слов
        // выдаёт всё подряд по самому частому из них
        $words = preg_split('/\s+/u', $query, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $path = storage_path(self::CORPUS);

        if (! is_file($path) || $words === []) {
            return response()->json([]);
        }

        $hits = [];
        $handle = fopen($path, 'r');

        while (($line = fgets($handle)) !== false) {
            // ё и е считаем одной буквой; замена не меняет длину,
            // поэтому позиции совпадения остаются верными для исходного текста
            $line = str_replace('ё', 'е', $line);

            // быстрая отбраковка по сырой строке, до разбора JSON
            foreach ($words as $word) {
                if (mb_stripos($line, $word) === false) {
                    continue 2;
                }
            }

            $row = json_decode($line, true);

            if (! is_array($row)) {
                continue;
            }

            $hit = $this->match($row, $words);

            if ($hit !== null) {
                $hits[] = $hit;
            }
        }

        fclose($handle);

        usort($hits, fn ($a, $b) => $a['score'] <=> $b['score'] ?: $a['pos'] <=> $b['pos']);

        $hits = array_map(
            fn ($h) => ['slug' => $h['slug'], 'id' => $h['id'], 'label' => $h['label'],
                        'module' => $h['module'], 'snippet' => $h['snippet']],
            array_slice($hits, 0, self::LIMIT)
        );

        return response()->json($hits);
    }

    /**
     * Проверяет раздел и строит результат с куском текста вокруг совпадения.
     */
    private function match(array $row, array $words): ?array
    {
        $text = (string) ($row['t'] ?? '');
        $haystack = str_replace('ё', 'е', $text);
        $first = null;

        foreach ($words as $word) {
            $pos = mb_stripos($haystack, $word);

            if ($pos === false) {
                return null;
            }

            if ($first === null || $pos < $first['pos']) {
                $first = ['pos' => $pos, 'len' => mb_strlen($word)];
            }
        }

        $label = (string) ($row['l'] ?? '');

        return [
            'slug'    => (string) ($row['m'] ?? ''),
            'module'  => (string) ($row['n'] ?? ''),
            'id'      => (string) ($row['s'] ?? ''),
            'label'   => $label,
            'snippet' => $this->snippet($text, $first['pos'], $first['len']),
            // совпадение в названии раздела важнее, чем где-то в тексте
            'score'   => mb_stripos(str_replace('ё', 'е', $label), $words[0]) !== false ? 0 : 1,
            'pos'     => $first['pos'],
        ];
    }

    /**
     * Кусок текста вокруг совпадения, обрезанный по границам слов.
     */
    private function snippet(string $text, int $pos, int $len): string
    {
        $before = (int) ((self::SNIPPET - $len) / 2);
        $start = max(0, $pos - $before);
        $piece = mb_substr($text, $start, self::SNIPPET);

        // не начинаем и не заканчиваем на половине слова
        if ($start > 0 && ($cut = mb_strpos($piece, ' ')) !== false) {
            $piece = mb_substr($piece, $cut + 1);
        }

        if (mb_strlen($text) > $start + self::SNIPPET && ($cut = mb_strrpos($piece, ' ')) !== false) {
            $piece = mb_substr($piece, 0, $cut);
        }

        return ($start > 0 ? '… ' : '') . trim($piece)
             . ($start + self::SNIPPET < mb_strlen($text) ? ' …' : '');
    }

    /** Та же нормализация, что и в индексе на стороне браузера. */
    private function normalize(string $s): string
    {
        $s = mb_strtolower(trim($s), 'UTF-8');
        $s = str_replace('ё', 'е', $s);

        return mb_substr($s, 0, 64);
    }
}
