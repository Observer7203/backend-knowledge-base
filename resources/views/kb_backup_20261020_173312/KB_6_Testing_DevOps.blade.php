@verbatim
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing & DevOps Knowledge Base - PHP/Laravel</title>
    <style>
  :root {
    --bg:           #F5F8FA;
    --surface:      #FFFFFF;
    --surface-light:#F5F8FA;
    --border:       #E4E6EF;
    --text:         #181C32;
    --text2:        #7E8299;
    --text3:        #A1A5B7;
    --primary:      #404357;
    --primary-light:#EFF2F5;
    --purple:       #7239EA;
    --purple-light: #F8F5FF;
    --success:      #50CD89;
    --success-light:#E8FFF3;
    --success-dark: #0D7D53;
    --warning:      #FFC700;
    --warning-light:#FFF8DD;
    --warning-dark: #B45309;
    --danger:       #F1416C;
    --danger-light: #FFF5F8;
    --info:         #7E8299;
    --info-light:   #EFF2F5;
    --teal:         #009EF7;
    --teal-light:   #EEF7FF;
    --shadow:       0 2px 10px rgba(24,28,50,0.07);
    --shadow-hover: 0 6px 20px rgba(24,28,50,0.11);
    --code-bg:      #1E1E2D;
    --code-border:  #2D3347;
    --radius:       10px;
  }

  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
    line-height: 1.6;
    font-size: 14px;
    padding: 0;
    -webkit-font-smoothing: antialiased;
  }

  .container {
    width: 100%;
    padding: 0 40px 60px;
  }

  /* Back link */
  .top-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 18px 0 0;
    margin-bottom: 8px;
  }
  .top-nav a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--primary);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 7px;
    transition: background 0.2s;
  }
  .top-nav a:hover { background: var(--primary-light); }
  .top-nav a svg { width: 14px; height: 14px; }

  /* Header */
  header, .header {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 36px 36px 32px;
    margin: 20px 0 32px;
    text-align: center;
    box-shadow: var(--shadow);
  }
  header h1, .header h1 {
    font-size: 26px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 10px;
    letter-spacing: -0.3px;
    background: none !important;
    -webkit-text-fill-color: unset !important;
    text-shadow: none !important;
  }
  header p, .header p, .subtitle {
    color: var(--text2);
    font-size: 14px;
    line-height: 1.65;
  }

  /* TOC */
  .table-of-contents, .toc {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px 26px;
    margin-bottom: 28px;
    box-shadow: var(--shadow);
  }
  .table-of-contents h2, .toc h2 {
    color: var(--text);
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .table-of-contents h2::before, .toc h2::before {
    content: '';
    width: 3px; height: 16px;
    background: var(--primary);
    border-radius: 2px;
  }
  .table-of-contents ul li a, .toc ul li a {
    color: var(--primary);
    text-decoration: none;
    font-size: 13px;
  }
  .table-of-contents ul li a:hover, .toc ul li a:hover { text-decoration: underline; }

  /* Sections */
  .section {
    background: var(--surface);
    border-radius: var(--radius);
    margin-bottom: 20px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: box-shadow 0.2s;
  }
  .section:hover { box-shadow: var(--shadow-hover); }

  .section-header {
    background: var(--surface);
    padding: 18px 24px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    user-select: none;
    transition: background 0.2s;
    border-bottom: 1px solid transparent;
  }
  .section-header:hover { background: var(--bg); }
  .section-header.active { border-bottom-color: var(--border); }

  .section-header h2 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section-header h2::before {
    content: '';
    width: 3px; height: 18px;
    background: var(--primary);
    border-radius: 2px;
    flex-shrink: 0;
  }

  .toggle-icon { font-size: 18px; color: var(--text3); transition: transform 0.3s; }
  .section-header.active .toggle-icon { transform: rotate(180deg); }

  .section-content {
    display: none;
    padding: 24px;
    border-top: 1px solid var(--border);
  }
  .section-content.active { display: block; }

  /* Subsections */
  .subsection { margin-bottom: 30px; }
  .subsection h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px dashed var(--border);
  }

  /* Code */
  pre {
    background: var(--code-bg);
    border: 1px solid var(--code-border);
    border-radius: 10px;
    padding: 20px;
    overflow-x: auto;
    margin: 14px 0;
    line-height: 1.55;
    font-size: 13px;
    font-family: 'JetBrains Mono','Fira Code','Monaco','Courier New',monospace;
  }
  code {
    font-family: 'JetBrains Mono','Fira Code','Monaco',monospace;
    font-size: 13px;
    background: rgba(64,67,87,0.08);
    color: var(--primary);
    padding: 1px 5px;
    border-radius: 4px;
  }
  pre code { background: none; color: #abb2bf; padding: 0; }
  .keyword  { color: #82AAFF; font-weight:600; }
  .string   { color: #C3E88D; }
  .comment  { color: #637777; font-style:italic; }
  .variable { color: #F78C6C; }
  .function { color: #82AAFF; }
  .number   { color: #F78C6C; }

  /* Content blocks */
  p { color: var(--text2); line-height:1.75; margin-bottom:12px; font-size:14px; }
  strong { color: var(--text); }

  /* Tables */
  table { width:100%; border-collapse:collapse; margin:16px 0; font-size:13px; border-radius:8px; overflow:hidden; border:1px solid var(--border); }
  th, td { padding:11px 14px; text-align:left; border-bottom:1px solid var(--border); }
  th { background: var(--bg); color: var(--text); font-weight:700; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; }
  tr:last-child td { border-bottom:none; }
  tr:hover td { background: var(--bg); }

  /* Lists */
  ul, ol { margin-left:20px; margin-top:10px; margin-bottom:14px; }
  li { margin-bottom:8px; color: var(--text2); font-size:13.5px; line-height:1.65; }
  li strong { color: var(--text); }
  li a { color: var(--primary); text-decoration:none; }
  li a:hover { text-decoration:underline; }

  /* Info boxes */
  .info-box, .note {
    background: var(--info-light);
    border-left: 4px solid var(--info);
    padding: 14px 18px;
    margin: 16px 0;
    border-radius: 0 8px 8px 0;
    font-size: 13.5px;
    color: var(--text);
    line-height: 1.65;
  }
  .warning-box {
    background: #EFF2F5;
    border-left: 4px solid var(--border);
    padding: 14px 18px;
    margin: 16px 0;
    border-radius: 0 8px 8px 0;
    font-size: 13.5px;
    color: var(--text);
    line-height: 1.65;
  }
  .danger-box {
    background: #EFF2F5;
    border-left: 4px solid var(--border);
    padding: 14px 18px;
    margin: 16px 0;
    border-radius: 0 8px 8px 0;
    font-size: 13.5px;
    color: var(--text);
    line-height: 1.65;
  }
  .success-box {
    background: #EFF2F5;
    border-left: 4px solid var(--border);
    padding: 14px 18px;
    margin: 16px 0;
    border-radius: 0 8px 8px 0;
    font-size: 13.5px;
    color: var(--text);
    line-height: 1.65;
  }

  /* Badges */
  .badge {
    display:inline-block;
    padding:3px 9px;
    border-radius:5px;
    font-size:11px;
    font-weight:700;
    margin-right:4px;
  }
  .badge-primary { background: var(--primary-light); color: var(--primary); }
  .badge-success { background: #EFF2F5; color: var(--success-dark); }
  .badge-warning { background: #EFF2F5; color: var(--warning-dark); }
  .badge-danger  { background: #EFF2F5;  color: #5E6278; }

  /* Headings inside content */
  h3 { font-size:15px; font-weight:700; color:var(--text); margin:20px 0 10px; }
  h4 { font-size:13.5px; font-weight:700; color:var(--text2); margin:16px 0 8px; }

  /* HR */
  hr { border:none; border-top:1px solid var(--border); margin:24px 0; }

  @media (max-width:768px) {
    .container { padding: 0 16px 40px; }
    header, .header { padding: 24px 20px; }
    .section-header { padding: 14px 18px; }
    .section-content { padding: 18px; }
  }

/* ── Mobile / tablet adaptation ────────────────────────────── */
@media (max-width: 900px) {
  .container { display: block; grid-template-columns: 1fr; }
  .sidebar {
    position: static; width: 100%; height: auto;
    max-height: 280px; overflow-y: auto;
    border-right: none; border-bottom: 1px solid var(--border);
    padding: 14px; box-shadow: none;
  }
  .sidebar-title { margin-bottom: 6px; padding-bottom: 8px; }
  .nav-item { padding: 6px 10px; font-size: 12.5px; }
  .nav-group-label { padding: 6px 10px 2px; }
  .main { margin-left: 0; width: 100%; padding: 20px 16px; }
  .page-header { margin-bottom: 18px; padding-bottom: 16px; }
  .page-header h1 { font-size: 22px; letter-spacing: -0.2px; }
  .page-header p { font-size: 13px; }
  .section-title { font-size: 17px; margin-bottom: 18px; padding-bottom: 10px; }
  .subsection { margin-bottom: 26px; }
  .subsection-title { font-size: 14px; margin-bottom: 10px; }
  p.text { font-size: 13.5px; line-height: 1.7; }
  .card { padding: 14px 16px; }
  .card h3 { font-size: 13.5px; }
  .pitfall { padding: 10px 12px; font-size: 12.5px; }
  .info-box { padding: 12px 14px; font-size: 12.5px; }
  pre { padding: 12px 14px; font-size: 11.5px; }
  .data-table { font-size: 12px; }
  .data-table th, .data-table td { padding: 7px 9px; }
  .badge-row { gap: 6px; }
  .badge { font-size: 10px; padding: 3px 8px; }
}

@media (max-width: 500px) {
  .sidebar { max-height: 220px; }
  .main { padding: 16px 12px; }
  .page-header h1 { font-size: 18px; }
  .section-title { font-size: 15px; }
  pre { padding: 10px 12px; font-size: 10.5px; overflow-x: auto; }
  .data-table { display: block; overflow-x: auto; white-space: nowrap; }
}

</style>
</head>
<body>
    <div class="container">

        <div class="top-nav"><a href="/"><i data-lucide="arrow-left"></i> На главную</a></div>
        <header>
            <h1>Testing & DevOps Knowledge Base</h1>
            <p>PHP/Laravel Backend Developer Guide - Master Testing, Deployment & Infrastructure</p>
        </header>

        <div class="toc">
            <h2>Table of Contents</h2>
            <div class="toc-section">
                <h3>PART 1: TESTING</h3>
                <ul>
                    <li><a href="#phpunit">1. PHPUnit Basics</a></li>
                    <li><a href="#unit-tests">2. Unit Tests</a></li>
                    <li><a href="#feature-tests">3. Feature Tests</a></li>
                    <li><a href="#mocking">4. Mocking & Fakes in Laravel</a></li>
                    <li><a href="#tdd">5. Test-Driven Development (TDD)</a></li>
                    <li><a href="#pest">6. Pest PHP</a></li>
                    <li><a href="#pyramid">7. Testing Pyramid</a></li>
                </ul>
            </div>
            <div class="toc-section">
                <h3>PART 2: DEVOPS</h3>
                <ul>
                    <li><a href="#docker">8. Docker Fundamentals</a></li>
                    <li><a href="#docker-compose">9. Docker Compose for Laravel</a></li>
                    <li><a href="#git">10. Git Advanced</a></li>
                    <li><a href="#github-actions">11. CI/CD with GitHub Actions</a></li>
                    <li><a href="#linux">12. Linux Basics for Backend</a></li>
                    <li><a href="#nginx">13. Nginx Configuration</a></li>
                    <li><a href="#deployment">14. Laravel Deployment</a></li>
                    <li><a href="#monitoring">15. Monitoring & Debugging</a></li>
                </ul>
            </div>
        </div>

        <!-- PART 1: TESTING -->

        <section id="phpunit">
            <h2>1. PHPUnit Basics</h2>

            <h3>Installation & Setup</h3>
            <p>PHPUnit is Laravel's default testing framework. It comes pre-configured with Laravel.</p>

            <pre><code class="bash-code">composer require --dev phpunit/phpunit
php artisan make:test UserTest --unit
php artisan make:test UserControllerTest</code></pre>

            <h3>Test Structure</h3>
            <pre><code class="php-code">&lt;?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function test_addition()
    {
        $result = 2 + 2;
        $this->assertEquals(4, $result);
    }
}</code></pre>

            <h3>Essential Assertions</h3>
            <p><strong>Assertions (утверждения)</strong> — методы класса <code>PHPUnit\Framework\TestCase</code>, доступные в любом тестовом классе Laravel (Laravel-ный <code>Tests\TestCase</code> наследует его). Каждый метод проверяет, соответствует ли <em>фактическое состояние</em> ожидаемому. Не совпало — тест валится с диагностическим сообщением.</p>
            <p><em>Почему через <code>$this-&gt;</code>:</em> потому что тестовый класс наследует <code>TestCase</code>, где эти методы объявлены. Без них тесты не имеют смысла — код прогонится, но никто не проверит результат.</p>
            <table>
                <tr>
                    <th>Assertion</th>
                    <th>Purpose</th>
                    <th>Example</th>
                </tr>
                <tr>
                    <td><code>assertEquals($expected, $actual)</code></td>
                    <td>Значения равны (loose <code>==</code>)</td>
                    <td><code>$this->assertEquals(5, 2+3);</code></td>
                </tr>
                <tr>
                    <td><code>assertSame($expected, $actual)</code></td>
                    <td>Идентичны (strict <code>===</code>, тип тоже)</td>
                    <td><code>$this->assertSame(5, 2+3);</code> — <code>'5'</code> не пройдёт</td>
                </tr>
                <tr>
                    <td><code>assertNotEquals()</code> / <code>assertNotSame()</code></td>
                    <td>Отрицания</td>
                    <td><code>$this->assertNotEquals(0, $count);</code></td>
                </tr>
                <tr>
                    <td><code>assertTrue($condition)</code></td>
                    <td>Выражение истинно</td>
                    <td><code>$this->assertTrue($user->isAdmin());</code></td>
                </tr>
                <tr>
                    <td><code>assertFalse($condition)</code></td>
                    <td>Выражение ложно</td>
                    <td><code>$this->assertFalse($user->isDeleted());</code></td>
                </tr>
                <tr>
                    <td><code>assertNull($value)</code></td>
                    <td>Значение равно <code>null</code></td>
                    <td><code>$this->assertNull($result);</code></td>
                </tr>
                <tr>
                    <td><code>assertNotNull($value)</code></td>
                    <td>Значение не <code>null</code></td>
                    <td><code>$this->assertNotNull($user);</code></td>
                </tr>
                <tr>
                    <td><code>assertInstanceOf($class, $object)</code></td>
                    <td>Объект — экземпляр класса (или наследника)</td>
                    <td><code>$this->assertInstanceOf(Order::class, $order);</code></td>
                </tr>
                <tr>
                    <td><code>assertCount($n, $collection)</code></td>
                    <td>Массив/коллекция содержит N элементов</td>
                    <td><code>$this->assertCount(3, $users);</code></td>
                </tr>
                <tr>
                    <td><code>assertEmpty()</code> / <code>assertNotEmpty()</code></td>
                    <td>Пусто / не пусто</td>
                    <td><code>$this->assertEmpty($errors);</code></td>
                </tr>
                <tr>
                    <td><code>assertContains($needle, $haystack)</code></td>
                    <td>Значение есть в массиве/коллекции</td>
                    <td><code>$this->assertContains('admin', $roles);</code></td>
                </tr>
                <tr>
                    <td><code>assertArrayHasKey($key, $array)</code></td>
                    <td>Массив содержит ключ</td>
                    <td><code>$this->assertArrayHasKey('email', $data);</code></td>
                </tr>
                <tr>
                    <td><code>assertGreaterThan()</code> / <code>assertLessThan()</code></td>
                    <td>Больше / меньше</td>
                    <td><code>$this->assertGreaterThan(0, $total);</code></td>
                </tr>
                <tr>
                    <td><code>assertMatchesRegularExpression($regex, $string)</code></td>
                    <td>Строка матчит regex</td>
                    <td><code>$this->assertMatchesRegularExpression('/^ORD-\d+$/', $order->number);</code></td>
                </tr>
                <tr>
                    <td><code>assertStringContainsString($needle, $haystack)</code></td>
                    <td>Подстрока в строке</td>
                    <td><code>$this->assertStringContainsString('error', $log);</code></td>
                </tr>
                <tr>
                    <td><code>assertDatabaseHas($table, $data)</code> (Laravel)</td>
                    <td>В таблице БД есть запись с этими полями</td>
                    <td><code>$this->assertDatabaseHas('orders', ['user_id' => 1]);</code></td>
                </tr>
                <tr>
                    <td><code>assertDatabaseMissing($table, $data)</code> (Laravel)</td>
                    <td>В таблице нет записи с этими полями</td>
                    <td><code>$this->assertDatabaseMissing('users', ['email' => 'x@y']);</code></td>
                </tr>
                <tr>
                    <td><code>assertJson($response)</code> (Laravel)</td>
                    <td>Ответ содержит JSON</td>
                    <td><code>$response->assertJson(['status' => 'ok']);</code></td>
                </tr>
                <tr>
                    <td><code>assertJsonStructure($structure)</code> (Laravel)</td>
                    <td>JSON имеет ожидаемую структуру ключей</td>
                    <td><code>$response->assertJsonStructure(['data' => ['id', 'total']]);</code></td>
                </tr>
            </table>

            <h3>Разбор реального теста: <code>test_order_can_be_created</code></h3>
            <p>Типичный feature-тест, показывающий как assertion-методы работают вместе:</p>
            <pre><code class="php-code">public function test_order_can_be_created()
{
    // Arrange — готовим окружение
    $user = User::factory()->create();

    // Act — одно действие
    $response = $this->actingAs($user)->post('/orders', [
        'items' => [['sku' => 'ABC-1', 'qty' => 2]],
    ]);

    // Assert — проверяем результат по нескольким осям
    $response->assertStatus(201);                          // HTTP-статус

    $order = Order::latest()->first();

    $this->assertInstanceOf(Order::class, $order);        // тип объекта
    $this->assertEquals($user->id, $order->user_id);      // связка user → order
    $this->assertDatabaseHas('orders', [                  // запись в БД
        'user_id' => $user->id,
        'status'  => 'pending',
    ]);
}</code></pre>

            <p><strong>Что делает каждая проверка:</strong></p>
            <ul>
                <li><code>assertStatus(201)</code> — HTTP-ответ 201 Created (метод <code>TestResponse</code>, не PHPUnit).</li>
                <li><code>assertInstanceOf(Order::class, $order)</code> — <code>$order</code> — экземпляр <code>Order</code> (или наследника). Если <code>latest()->first()</code> вернул <code>null</code> — тест упадёт здесь с понятным сообщением, а не на следующей строке с непонятным «Trying to get property of non-object».</li>
                <li><code>assertEquals($user->id, $order->user_id)</code> — заказ действительно привязан к тому пользователю, который его создавал.</li>
                <li><code>assertDatabaseHas(...)</code> — Laravel-специфичная проверка: в таблице <code>orders</code> реально лежит строка с этими полями. Более надёжно, чем полагаться только на in-memory объект.</li>
            </ul>

            <h3>Где какие используются</h3>
            <ul>
                <li><strong>Unit-тесты</strong> — отдельные классы и методы (сервисы, actions, модели). Обычно только PHPUnit-ассерты: <code>assertEquals</code>, <code>assertInstanceOf</code>, <code>assertTrue</code>, <code>assertCount</code>.</li>
                <li><strong>Feature-тесты</strong> — маршрут → контроллер → middleware → БД. PHPUnit-ассерты + Laravel: <code>assertStatus</code>, <code>assertRedirect</code>, <code>assertJson</code>, <code>assertJsonStructure</code>, <code>assertDatabaseHas</code>, <code>assertSee</code>.</li>
            </ul>

            <h3>Test Lifecycle</h3>
            <pre><code class="php-code">class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Runs before EACH test
        $this->user = User::factory()->create();
    }

    protected function tearDown(): void
    {
        // Runs after EACH test
        parent::tearDown();
    }

    public function test_user_exists()
    {
        $this->assertNotNull($this->user);
    }
}</code></pre>

            <h3>Data Providers</h3>
            <pre><code class="php-code">/**
 * @dataProvider emailProvider
 */
public function test_email_validation($email, $isValid)
{
    $result = filter_var($email, FILTER_VALIDATE_EMAIL);
    $this->assertEquals($isValid, $result !== false);
}

public static function emailProvider()
{
    return [
        'valid email' => ['user@example.com', true],
        'invalid email' => ['invalid@', false],
        'no domain' => ['user@', false],
    ];
}</code></pre>

            <h3>Running Tests</h3>
            <pre><code class="bash-code"># Run all tests
php artisan test

# Run specific test class
php artisan test tests/Unit/UserTest.php

# Run tests matching pattern
php artisan test --filter=email_validation

# Run tests in parallel
php artisan test --parallel

# Run with coverage
php artisan test --coverage

# Run specific test group
php artisan test --group=auth</code></pre>

            <h3>Test Groups</h3>
            <pre><code class="php-code">#[Group('auth')]
public function test_user_login()
{
    // ...
}</code></pre>

            <div class="quiz-box">
                <h4>Проверь себя: PHPUnit Basics</h4>
                <div class="quiz-question">
                    <strong>Q1: What is the difference between setUp() and the constructor?</strong>
                    <div class="quiz-answer">A: setUp() is called before EACH test method, while constructor is called once. setUp() is the standard place to initialize test fixtures.</div>
                </div>
                <div class="quiz-question">
                    <strong>Q2: When would you use @dataProvider?</strong>
                    <div class="quiz-answer">A: When testing the same function with multiple input/output combinations. It reduces code duplication and makes tests more readable.</div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Exercise: Create PHPUnit Test</h4>
                <p><strong>Task:</strong> Create a test file for a simple Calculator class with methods add(), subtract(), multiply(), divide(). Write tests using data providers to test multiple scenarios for each method. Run with coverage.</p>
                <p><strong>Hint:</strong> Create the Calculator class first, then write feature tests using test() function.</p>
            </div>

            <div class="reference">
                <strong>Reference:</strong> <a href="https://phpunit.de/" style="color: #74b9ff;">PHPUnit Documentation</a> | <a href="https://laravel.com/docs/testing" style="color: #74b9ff;">Laravel Testing Guide</a>
            </div>
        </section>

        <section id="unit-tests">
            <h2>2. Unit Tests</h2>

            <h3>What to Test in Unit Tests</h3>
            <p>Unit tests focus on small, isolated pieces of code. Test business logic, calculations, and pure functions.</p>

            <ul>
                <li><strong>Pure functions:</strong> Functions that always return the same output for same input</li>
                <li><strong>Service methods:</strong> Business logic in service classes</li>
                <li><strong>Calculations:</strong> Complex formulas and computations</li>
                <li><strong>Validators:</strong> Custom validation rules</li>
                <li><strong>Model methods:</strong> Computed properties, relationships (mocked)</li>
            </ul>

            <h3>Isolation with Mocking</h3>
            <p>Unit tests must be isolated. Use Mockery to mock dependencies:</p>
            <pre><code class="php-code">use Mockery;

class OrderServiceTest extends TestCase
{
    public function test_order_total_with_discount()
    {
        // Mock the discount service
        $discountService = Mockery::mock(DiscountService::class);
        $discountService
            ->shouldReceive('getDiscount')
            ->with(100)
            ->andReturn(10); // 10% discount

        $service = new OrderService($discountService);
        $total = $service->calculateTotal(100);

        $this->assertEquals(90, $total);
    }
}</code></pre>

            <h3>Practical Example: Order Calculator Service</h3>
            <pre><code class="php-code">// Service class
class OrderCalculator
{
    public function calculateTotal(Order $order, TaxService $taxService): float
    {
        $subtotal = $order->items->sum('price');
        $tax = $taxService->calculate($subtotal);
        return $subtotal + $tax;
    }
}

// Test
class OrderCalculatorTest extends TestCase
{
    public function test_calculates_total_with_tax()
    {
        $taxService = Mockery::mock(TaxService::class);
        $taxService->shouldReceive('calculate')->with(100)->andReturn(10);

        $order = Mockery::mock(Order::class);
        $order->items = collect([
            ['price' => 50],
            ['price' => 50],
        ]);

        $calculator = new OrderCalculator();
        $total = $calculator->calculateTotal($order, $taxService);

        $this->assertEquals(110, $total);
    }
}</code></pre>

            <h3>Testing Pure Functions</h3>
            <pre><code class="php-code">class StringHelper
{
    public static function slugify(string $text): string
    {
        return strtolower(
            preg_replace('/[^a-z0-9]+/', '-', $text)
        );
    }
}

// No mocking needed for pure functions!
class StringHelperTest extends TestCase
{
    public function test_slugify()
    {
        $this->assertEquals('hello-world', StringHelper::slugify('Hello World'));
        $this->assertEquals('test-123', StringHelper::slugify('Test 123!'));
    }
}</code></pre>

            <div class="key-concept">
                <strong>Key Principle:</strong> Unit tests should run in milliseconds and require no database or external services. If a test touches the database, it's an integration test, not a unit test.
            </div>

            <div class="quiz-box">
                <h4>Проверь себя: Unit Tests</h4>
                <div class="quiz-question">
                    <strong>Q1: Why mock dependencies in unit tests?</strong>
                    <div class="quiz-answer">A: Mocking isolates the unit being tested from external dependencies, making tests fast, reliable, and focused on a single responsibility.</div>
                </div>
                <div class="quiz-question">
                    <strong>Q2: Should you mock methods in the class you're testing?</strong>
                    <div class="quiz-answer">A: No. You test the real implementation of the class. Only mock its dependencies (external services, repositories, etc).</div>
                </div>
            </div>
        </section>

        <section id="feature-tests">
            <h2>3. Feature Tests</h2>

            <h3>HTTP Testing Basics</h3>
            <p>Feature tests test entire HTTP requests/responses. They exercise controllers, middleware, and routing.</p>

            <pre><code class="php-code">use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_view_users()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->assertJson(['data' => []]);
    }

    public function test_can_create_user()
    {
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }
}</code></pre>

            <h3>HTTP Method Testing</h3>
            <table>
                <tr>
                    <th>Method</th>
                    <th>Usage</th>
                </tr>
                <tr>
                    <td><code>$this->get()</code></td>
                    <td>GET request</td>
                </tr>
                <tr>
                    <td><code>$this->post()</code></td>
                    <td>POST request</td>
                </tr>
                <tr>
                    <td><code>$this->put()</code></td>
                    <td>PUT request (full update)</td>
                </tr>
                <tr>
                    <td><code>$this->patch()</code></td>
                    <td>PATCH request (partial update)</td>
                </tr>
                <tr>
                    <td><code>$this->delete()</code></td>
                    <td>DELETE request</td>
                </tr>
            </table>

            <h3>Response Assertions</h3>
            <pre><code class="php-code">$response = $this->get('/users/1');

$response->assertStatus(200);              // Check HTTP status
$response->assertOk();                     // Assert 200
$response->assertJson(['name' => 'John']); // Check JSON
$response->assertJsonPath('user.id', 1);   // Check nested path
$response->assertSee('John');              // Check visible text
$response->assertRedirect('/dashboard');   // Check redirect
$response->assertCookie('session_id');     // Check cookie
$response->assertHeader('Content-Type');   // Check header
$response->assertJsonCount(5, 'data');     // Check array length</code></pre>

            <h3>Testing Authenticated Routes</h3>
            <pre><code class="php-code">class ProtectedRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthorized_user_cannot_access()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
    }

    public function test_only_admin_can_delete()
    {
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user)->delete('/users/1')->assertForbidden();
        $this->actingAs($admin)->delete('/users/1')->assertOk();
    }
}</code></pre>

            <h3>RefreshDatabase Trait</h3>
            <p>Use <code>RefreshDatabase</code> trait to reset database after each test:</p>
            <pre><code class="php-code">class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        User::factory()->count(5)->create();

        $response = $this->post('/api/users', ['name' => 'Jane']);

        $this->assertDatabaseCount('users', 6);
        $this->assertDatabaseHas('users', ['name' => 'Jane']);
    }
}</code></pre>

            <h3>Testing JSON APIs</h3>
            <pre><code class="php-code">class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_paginated_products()
    {
        Product::factory()->count(15)->create();

        $response = $this->getJson('/api/products?page=1');

        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'price']
                     ],
                     'meta' => ['total', 'per_page', 'current_page']
                 ])
                 ->assertJsonCount(10, 'data');
    }
}</code></pre>

            <div class="key-concept">
                <strong>RefreshDatabase vs DatabaseTransactions:</strong> RefreshDatabase runs migrations after each test (slower but cleaner). DatabaseTransactions rolls back within a transaction (faster). Use RefreshDatabase for most tests.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Feature Test for API Endpoint</h4>
                <p><strong>Task:</strong> Write a complete feature test for a Blog API with endpoints: GET /blogs (paginated), POST /blogs (create), GET /blogs/{id}, PUT /blogs/{id}, DELETE /blogs/{id}. Test authentication, validation errors, and successful operations.</p>
            </div>
        </section>

        <section id="mocking">
            <h2>4. Mocking & Fakes in Laravel</h2>

            <h3>When to Mock vs Fake</h3>
            <p><strong>Fakes:</strong> Built-in Laravel test doubles that simulate behavior (Event::fake, Queue::fake). Use these when available.</p>
            <p><strong>Mocks (Mockery):</strong> Manual mocks for custom dependencies. Use when fakes don't exist.</p>

            <h3>Event Fakes</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Event;

class OrderTest extends TestCase
{
    public function test_dispatches_order_created_event()
    {
        Event::fake();

        Order::create(['total' => 100]);

        Event::assertDispatched(OrderCreated::class);
    }

    public function test_event_contains_correct_data()
    {
        Event::fake();

        $order = Order::create(['total' => 100]);

        Event::assertDispatched(OrderCreated::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }
}</code></pre>

            <h3>Queue Fakes</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Queue;

class EmailTest extends TestCase
{
    public function test_sends_welcome_email_via_queue()
    {
        Queue::fake();

        User::create(['email' => 'user@example.com']);

        Queue::assertPushed(SendWelcomeEmail::class);
    }

    public function test_job_pushed_to_correct_queue()
    {
        Queue::fake();

        User::create(['email' => 'user@example.com']);

        Queue::assertPushedOn('emails', SendWelcomeEmail::class);
    }
}</code></pre>

            <h3>Notification Fakes</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Notification;

class OrderNotificationTest extends TestCase
{
    public function test_sends_notification_on_order_shipped()
    {
        Notification::fake();

        $order = Order::factory()->create();
        $order->update(['status' => 'shipped']);

        Notification::assertSentTo($order->user, OrderShipped::class);
    }
}</code></pre>

            <h3>Mail Fakes</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Mail;

class MailTest extends TestCase
{
    public function test_welcome_mail_sent()
    {
        Mail::fake();

        Mail::to('user@example.com')->send(new WelcomeEmail('John'));

        Mail::assertSent(WelcomeEmail::class, function ($mail) {
            return $mail->hasTo('user@example.com');
        });
    }
}</code></pre>

            <h3>HTTP Fakes (External API Calls)</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Http;

class PaymentServiceTest extends TestCase
{
    public function test_payment_gateway_integration()
    {
        Http::fake([
            'api.payment.com/*' => Http::response(['status' => 'success'], 200),
        ]);

        $result = PaymentService::charge('4111111111111111', 100);

        $this->assertTrue($result);
        Http::assertSent(function ($request) {
            return $request->url() == 'api.payment.com/charge';
        });
    }
}</code></pre>

            <h3>Storage Fakes</h3>
            <pre><code class="php-code">use Illuminate\Support\Facades\Storage;

class UploadTest extends TestCase
{
    public function test_file_upload()
    {
        Storage::fake('avatars');

        $response = $this->post('/upload', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        Storage::disk('avatars')->assertExists('avatar.jpg');
    }
}</code></pre>

            <div class="key-concept">
                <strong>Fake vs Mock:</strong> Fakes are test doubles that Laravel provides. Mockery is a more powerful library for creating custom mocks. Prefer Laravel fakes when available (Event::fake, Queue::fake) over Mockery.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Complete Mocking Scenario</h4>
                <p><strong>Task:</strong> Write a test for a UserService that: 1) Creates a user, 2) Sends welcome email via queue, 3) Dispatches UserCreated event. Test all three behaviors are triggered without actually sending emails or processing queues.</p>
            </div>
        </section>

        <section id="tdd">
            <h2>5. Test-Driven Development (TDD)</h2>

            <h3>The Red → Green → Refactor Cycle</h3>
            <p><strong>Red:</strong> Write a failing test that describes desired behavior.</p>
            <p><strong>Green:</strong> Write minimal code to make the test pass.</p>
            <p><strong>Refactor:</strong> Improve code quality while keeping tests passing.</p>

            <h3>Real Example: Building a Discount System TDD-Style</h3>

            <h4>Step 1: RED - Write the failing test</h4>
            <pre><code class="php-code">class DiscountServiceTest extends TestCase
{
    public function test_first_time_customer_gets_10_percent_discount()
    {
        $service = new DiscountService();
        $customer = Customer::factory()->create(['orders_count' => 0]);

        $discount = $service->calculateDiscount($customer);

        $this->assertEquals(0.10, $discount);
    }
}</code></pre>

            <h4>Step 2: GREEN - Minimal implementation</h4>
            <pre><code class="php-code">class DiscountService
{
    public function calculateDiscount(Customer $customer): float
    {
        return 0.10; // Hardcoded, but test passes!
    }
}</code></pre>

            <h4>Step 3: RED - Add another test</h4>
            <pre><code class="php-code">public function test_returning_customer_with_3_orders_gets_15_percent()
{
    $service = new DiscountService();
    $customer = Customer::factory()->create(['orders_count' => 3]);

    $discount = $service->calculateDiscount($customer);

    $this->assertEquals(0.15, $discount);
}</code></pre>

            <h4>Step 4: GREEN - Real implementation</h4>
            <pre><code class="php-code">public function calculateDiscount(Customer $customer): float
{
    if ($customer->orders_count === 0) {
        return 0.10;
    }
    if ($customer->orders_count >= 3) {
        return 0.15;
    }
    return 0.05;
}</code></pre>

            <h4>Step 5: REFACTOR - Improve without changing behavior</h4>
            <pre><code class="php-code">public function calculateDiscount(Customer $customer): float
{
    return match (true) {
        $customer->orders_count === 0 => 0.10,
        $customer->orders_count >= 3 => 0.15,
        default => 0.05,
    };
}</code></pre>

            <h3>When TDD is Most Valuable</h3>
            <ul>
                <li><strong>Complex business logic:</strong> TDD helps design the API and edge cases</li>
                <li><strong>Refactoring:</strong> Tests ensure behavior doesn't change</li>
                <li><strong>Legacy code:</strong> Write tests before modifying untested code</li>
            </ul>

            <h3>When TDD Can Be Overkill</h3>
            <ul>
                <li>Simple CRUD operations with standard patterns</li>
                <li>Throwaway proof-of-concept code</li>
                <li>Heavy UI work with frequent visual changes</li>
            </ul>

            <div class="reference">
                <strong>Reference:</strong> Kent Beck - "Test Driven Development: By Example" is the definitive guide on TDD principles and practices.
            </div>

            <div class="exercise-box">
                <h4>Exercise: TDD A Complete Feature</h4>
                <p><strong>Task:</strong> Use TDD to build a Product Recommendation system. Start with: 1) Customers get recommendations based on purchase history, 2) Similar products are ranked by relevance, 3) Bought items are excluded. Write tests first, then implementation.</p>
            </div>
        </section>

        <section id="pest">
            <h2>6. Pest PHP</h2>

            <h3>What is Pest?</h3>
            <p>Pest is a modern PHP testing framework built on PHPUnit. It's cleaner, more expressive syntax with focus on readability.</p>

            <h3>Installation</h3>
            <pre><code class="bash-code">composer require --dev pestphp/pest pestphp/pest-plugin-laravel</code></pre>

            <h3>Syntax: test() vs it()</h3>
            <p>Pest uses simple <code>test()</code> and <code>it()</code> functions instead of class-based tests:</p>
            <pre><code class="php-code">// Pest syntax
test('user can login', function () {
    $user = User::factory()->create(['password' => 'secret']);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'secret',
    ]);

    $response->assertRedirect('/dashboard');
});

// Alternative: More readable with it()
it('logs in with valid credentials', function () {
    $user = User::factory()->create(['password' => 'secret']);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'secret',
    ])->assertRedirect('/dashboard');
});</code></pre>

            <h3>Pest Expectations API</h3>
            <pre><code class="php-code">// Old PHPUnit style
$this->assertEquals(5, $result);
$this->assertTrue($user->isAdmin());

// Pest expectations (more fluent)
expect($result)->toBe(5);
expect($user->isAdmin())->toBeTrue();
expect($users)->toHaveCount(3);
expect($email)->toMatch('/\S+@\S+\.\S+/');</code></pre>

            <h3>Higher-Order Tests</h3>
            <p>Pest allows skipping tests with <code>->skip()</code> or marking as <code>->todo()</code>:</p>
            <pre><code class="php-code">it('validates email format', function () {
    expect('invalid@')->not()->toMatch('/\S+@\S+\.\S+/');
})->skip();

it('implements payment processing', function () {
    // Not implemented yet
})->todo();</code></pre>

            <h3>Arch Testing (Structural Tests)</h3>
            <p>Pest can test code architecture and dependencies:</p>
            <pre><code class="php-code">use Pest\Arch\Targets\Target;

// Ensure Services don't depend on Controllers
arch()
    ->set('Services', 'app/Services')
    ->set('Controllers', 'app/Http/Controllers')
    ->expect('Services')
    ->not()
    ->toUse('Controllers');

// Ensure proper domain structure
arch()
    ->set('Models', 'app/Models')
    ->set('Jobs', 'app/Jobs')
    ->expect('Jobs')
    ->toUse('Models');</code></pre>

            <h3>Migration from PHPUnit</h3>
            <p>You can mix PHPUnit and Pest in the same project. Gradually migrate:</p>
            <pre><code class="bash-code"># Convert existing tests
composer require pestphp/pest-plugin-drift --dev
php artisan pest:drift</code></pre>

            <div class="success">
                <strong>Pest Advantages:</strong> Cleaner syntax, expectations API is more readable, arch testing for structural validation, built-in higher-order testing.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Rewrite in Pest</h4>
                <p><strong>Task:</strong> Take your PHPUnit tests from previous exercises and rewrite using Pest syntax. Use expectations API instead of assertions. Add arch tests to ensure your services don't depend on controllers.</p>
            </div>
        </section>

        <section id="pyramid">
            <h2>7. Testing Pyramid</h2>

            <h3>The Pyramid Structure</h3>
            <div class="pyramid">
┌────────────────┐<br>
│   E2E Tests    │ Few, slow (seconds)<br>
│  (UI/Browser)  │ Slow feedback<br>
└────────────────┘<br>
<br>
┌──────────────────┐<br>
│ Integration      │ Some, medium speed<br>
│ (API, Database)  │ 100s milliseconds<br>
└──────────────────┘<br>
<br>
┌────────────────────┐<br>
│   Unit Tests       │ Many, fast (ms)<br>
│ (Business Logic)   │ Instant feedback<br>
└────────────────────┘<br>
            </div>

            <h3>Level 1: Unit Tests (Base)</h3>
            <ul>
                <li><strong>Goal:</strong> Test isolated business logic</li>
                <li><strong>Coverage:</strong> 70-80% of code should be here</li>
                <li><strong>Speed:</strong> Run in milliseconds</li>
                <li><strong>Examples:</strong> Service methods, calculations, validators</li>
                <li><strong>Isolation:</strong> Mock all dependencies</li>
            </ul>

            <h3>Level 2: Integration Tests (Middle)</h3>
            <ul>
                <li><strong>Goal:</strong> Test multiple components working together</li>
                <li><strong>Coverage:</strong> 15-20% of code</li>
                <li><strong>Speed:</strong> 100s of milliseconds</li>
                <li><strong>Examples:</strong> Repository queries, API endpoints, database transactions</li>
                <li><strong>Scope:</strong> Use real database or in-memory SQLite</li>
            </ul>

            <h3>Level 3: E2E Tests (Top)</h3>
            <ul>
                <li><strong>Goal:</strong> Test complete user workflows</li>
                <li><strong>Coverage:</strong> 5-10% of code (critical happy paths)</li>
                <li><strong>Speed:</strong> Seconds per test</li>
                <li><strong>Examples:</strong> Complete purchase flow, user registration → login</li>
                <li><strong>Tools:</strong> Laravel Dusk, Selenium, Playwright</li>
            </ul>

            <h3>Coverage Targets</h3>
            <pre><code class="bash-code"># Generate coverage report
php artisan test --coverage

# Expected by level:
# - Critical business logic: 80-95% coverage
# - Controllers/actions: 60-80% coverage
# - Simple getters/setters: 20-40% coverage
# - Overall target: 60-75% for health</code></pre>

            <h3>Coverage Configuration</h3>
            <pre><code class="php-code">// phpunit.xml
&lt;coverage processUncoveredFiles="true"&gt;
    &lt;include&gt;
        &lt;directory suffix=".php"&gt;app&lt;/directory&gt;
    &lt;/include&gt;
    &lt;exclude&gt;
        &lt;directory&gt;app/Console&lt;/directory&gt;
        &lt;directory&gt;app/Exceptions&lt;/directory&gt;
    &lt;/exclude&gt;
&lt;/coverage&gt;</code></pre>

            <div class="key-concept">
                <strong>Pyramid Rule:</strong> Many fast unit tests, fewer integration tests, very few slow E2E tests. This gives you fast feedback while ensuring critical paths work end-to-end.
            </div>

            <div class="reference">
                <strong>Reference:</strong> Martin Fowler's "TestPyramid" essay is the foundational work on this testing strategy.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Analyze Test Pyramid</h4>
                <p><strong>Task:</strong> Take an existing Laravel project (or create a simple one with 3 features). Write tests for it following the pyramid: 1) 10+ unit tests, 2) 3-4 integration tests, 3) 1 E2E test. Generate coverage report and identify gaps.</p>
            </div>
        </section>

        <!-- PART 2: DEVOPS -->

        <section id="docker" class="devops">
            <h2>8. Docker Fundamentals</h2>

            <h3>Images vs Containers</h3>
            <p><strong>Image:</strong> Blueprint/template with OS, dependencies, code (immutable).</p>
            <p><strong>Container:</strong> Running instance of an image (mutable runtime).</p>

            <pre><code class="bash-code"># Images are like classes, containers are instances
docker images                    # List images
docker run image-name            # Create and run container from image
docker ps                        # List running containers
docker ps -a                     # List all containers</code></pre>

            <h3>Dockerfile Instructions</h3>
            <table>
                <tr>
                    <th>Instruction</th>
                    <th>Purpose</th>
                    <th>Example</th>
                </tr>
                <tr>
                    <td><code>FROM</code></td>
                    <td>Base image</td>
                    <td><code>FROM php:8.2-fpm</code></td>
                </tr>
                <tr>
                    <td><code>RUN</code></td>
                    <td>Execute command</td>
                    <td><code>RUN apt-get install -y curl</code></td>
                </tr>
                <tr>
                    <td><code>COPY</code></td>
                    <td>Copy from host to image</td>
                    <td><code>COPY . /app</code></td>
                </tr>
                <tr>
                    <td><code>WORKDIR</code></td>
                    <td>Set working directory</td>
                    <td><code>WORKDIR /app</code></td>
                </tr>
                <tr>
                    <td><code>EXPOSE</code></td>
                    <td>Expose port (documentation)</td>
                    <td><code>EXPOSE 9000</code></td>
                </tr>
                <tr>
                    <td><code>CMD</code></td>
                    <td>Default command</td>
                    <td><code>CMD ["php-fpm"]</code></td>
                </tr>
                <tr>
                    <td><code>ENTRYPOINT</code></td>
                    <td>Force command</td>
                    <td><code>ENTRYPOINT ["php"]</code></td>
                </tr>
            </table>

            <h3>Basic Dockerfile for Laravel</h3>
            <pre><code class="docker-code">FROM php:8.2-fpm

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo_pgsql zip

# Copy application
COPY . .

# Install composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]</code></pre>

            <h3>Layers and Caching</h3>
            <p>Each instruction creates a layer. Docker caches layers for faster builds:</p>

            <pre><code class="docker-code"># Bad: System packages + composer install in one layer
RUN apt-get install -y curl && composer install

# Good: Separate layers for better caching
RUN apt-get update && apt-get install -y curl
RUN composer install

# Better: Install composer deps with cached composer.lock
COPY composer.* ./
RUN composer install --no-dev
COPY . .
RUN npm run build  # Only rebuilds if source changes</code></pre>

            <h3>Multi-Stage Builds</h3>
            <p>Use multiple stages to reduce final image size:</p>
            <pre><code class="docker-code"># Stage 1: Builder
FROM php:8.2 as builder

WORKDIR /build
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Stage 2: Runtime (smaller)
FROM php:8.2-fpm

WORKDIR /app
COPY --from=builder /build /app

EXPOSE 9000
CMD ["php-fpm"]</code></pre>

            <h3>Building and Running</h3>
            <pre><code class="bash-code"># Build image
docker build -t myapp:1.0 .

# Build with build args
docker build --build-arg PHP_VERSION=8.1 -t myapp .

# Run container
docker run -p 9000:9000 myapp:1.0

# Run with volume (live code)
docker run -v /path/to/app:/app -p 9000:9000 myapp:1.0

# Run in background
docker run -d -p 9000:9000 myapp:1.0

# Execute command in running container
docker exec container-name php artisan migrate</code></pre>

            <div class="warning">
                <strong>Image Size Matters:</strong> Every layer adds to image size. Combine RUN commands when possible, use .dockerignore to exclude files, and clean package manager caches.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Build Multi-Stage Docker Image</h4>
                <p><strong>Task:</strong> Create a multi-stage Dockerfile for Laravel that: 1) Builds assets in first stage, 2) Installs composer dependencies, 3) Final stage only contains runtime files. Verify image size reduction.</p>
            </div>
        </section>

        <section id="docker-compose" class="devops">
            <h2>9. Docker Compose for Laravel</h2>

            <h3>Full Stack Setup: PHP + Nginx + MySQL + Redis</h3>
            <pre><code class="yaml-code">version: '3.8'

services:
  app:
    build: .
    container_name: laravel_app
    working_dir: /app
    volumes:
      - ./:/app
    ports:
      - "9000:9000"
    environment:
      - DB_HOST=mysql
      - REDIS_HOST=redis
    depends_on:
      - mysql
      - redis
    networks:
      - laravel

  nginx:
    image: nginx:alpine
    container_name: laravel_nginx
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/app
      - ./docker/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./docker/certs:/etc/nginx/certs
    depends_on:
      - app
    networks:
      - laravel

  mysql:
    image: mysql:8.0
    container_name: laravel_mysql
    environment:
      MYSQL_DATABASE: laravel
      MYSQL_USER: laravel
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: root
    volumes:
      - mysql_data:/var/lib/mysql
      - ./docker/mysql.cnf:/etc/mysql/conf.d/my.cnf
    ports:
      - "3306:3306"
    networks:
      - laravel

  redis:
    image: redis:7-alpine
    container_name: laravel_redis
    ports:
      - "6379:6379"
    volumes:
      - redis_data:/data
    networks:
      - laravel

volumes:
  mysql_data:
  redis_data:

networks:
  laravel:
    driver: bridge</code></pre>

            <h3>Essential Commands</h3>
            <pre><code class="bash-code"># Start all services
docker-compose up -d

# View logs
docker-compose logs app
docker-compose logs -f nginx  # Follow logs

# Run one-off command
docker-compose exec app php artisan migrate
docker-compose exec mysql mysql -u root -proot laravel

# Stop services
docker-compose down

# Remove volumes (⚠️ deletes data)
docker-compose down -v

# Rebuild images
docker-compose build --no-cache</code></pre>

            <h3>Nginx Configuration Example</h3>
            <pre><code class="yaml-code">server {
    listen 80;
    server_name localhost;

    root /app/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}</code></pre>

            <h3>Laravel Sail (Docker Alternative)</h3>
            <p>Laravel Sail is a pre-built Docker setup for Laravel:</p>
            <pre><code class="bash-code"># Install Sail in new project
composer require laravel/sail --dev
php artisan sail:install

# Start services
./vendor/bin/sail up -d

# Run commands
./vendor/bin/sail artisan migrate
./vendor/bin/sail tinker</code></pre>

            <div class="key-concept">
                <strong>Volumes:</strong> Bind mounts (./:/app) share host files with container. Named volumes (mysql_data:/var/lib/mysql) persist data across container restarts.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Docker Compose Stack</h4>
                <p><strong>Task:</strong> Create a complete docker-compose.yml for a Laravel project with: 1) PHP-FPM container, 2) Nginx reverse proxy, 3) PostgreSQL database, 4) Redis cache. Get a fresh Laravel app running in containers with all services communicating.</p>
            </div>
        </section>

        <section id="git" class="devops">
            <h2>10. Git Advanced</h2>

            <h3>Branching Strategies</h3>

            <h4>GitFlow</h4>
            <ul>
                <li><strong>main:</strong> Production-ready code</li>
                <li><strong>develop:</strong> Integration branch</li>
                <li><strong>feature/name:</strong> New features from develop</li>
                <li><strong>hotfix/name:</strong> Critical fixes from main</li>
                <li><strong>release/version:</strong> Release preparation</li>
            </ul>

            <pre><code class="bash-code"># GitFlow workflow
git checkout -b feature/user-auth develop
# ... make changes ...
git commit -m "feat: add user authentication"
git push origin feature/user-auth

# Create pull request, code review, then merge to develop
git checkout develop && git pull
git merge --no-ff feature/user-auth
git push origin develop</code></pre>

            <h4>Trunk-Based Development</h4>
            <ul>
                <li>Short-lived feature branches (1-2 days max)</li>
                <li>Frequent merges to main</li>
                <li>Feature flags for incomplete features</li>
                <li>Requires strong CI/CD pipeline</li>
            </ul>

            <pre><code class="bash-code"># Trunk-based: Quick iterations
git checkout -b feature/payment-processing
# ... 2 hours of work ...
git commit -m "feat: stripe payment integration"
git push && create PR

# Merge and immediately deploy
git checkout main && git pull
git merge feature/payment-processing
git push  # CI/CD deploys automatically</code></pre>

            <h3>Rebase vs Merge</h3>

            <h4>Merge (Default)</h4>
            <pre><code class="bash-code"># Creates merge commit
git checkout main
git merge feature/x

# History shows branching:
# * commit (merge commit)
# |\
# | * feature commit
# | * feature commit
# |/
# * main commit</code></pre>

            <h4>Rebase (Linear History)</h4>
            <pre><code class="bash-code"># Replay commits on top of main
git rebase main

# History is linear:
# * feature commit 2
# * feature commit 1
# * main commit</code></pre>

            <h3>Squash Commits Before Merge</h3>
            <pre><code class="bash-code"># Interactive rebase to squash
git rebase -i HEAD~3

# Mark commits:
# pick abc123 First commit
# squash def456 Second commit (combine with above)
# squash ghi789 Third commit (combine with above)

# Result: Single clean commit</code></pre>

            <h3>Cherry-Pick Specific Commits</h3>
            <pre><code class="bash-code"># Apply specific commit to current branch
git cherry-pick abc123

# Useful for backporting fixes to release branch
git checkout release/v2.0
git cherry-pick bugfix-commit-hash</code></pre>

            <h3>Stash for Context Switching</h3>
            <pre><code class="bash-code"># Save work without committing
git stash

# Switch to another branch, fix urgent issue
git checkout hotfix/critical-bug
# ... fix and commit ...

# Return to original work
git checkout feature/my-feature
git stash pop</code></pre>

            <h3>Conventional Commits</h3>
            <p>Standard commit format for clarity:</p>
            <pre><code class="bash-code">feat: add user authentication with OAuth
fix: resolve race condition in cache layer
docs: update API documentation
style: format code with PHP-CS-Fixer
refactor: simplify payment service
test: add unit tests for OrderCalculator
chore: upgrade Laravel to 10.0

# Breaking changes
feat!: change API response structure</code></pre>

            <h3>Pre-Commit Hooks</h3>
            <pre><code class="bash-code">#!/bin/sh
# .git/hooks/pre-commit

# Run PHP linter
./vendor/bin/php-cs-fixer fix --dry-run
if [ $? -ne 0 ]; then
    echo "PHP-CS-Fixer failed. Run: ./vendor/bin/php-cs-fixer fix"
    exit 1
fi

# Run tests
php artisan test --stop-on-failure
if [ $? -ne 0 ]; then
    echo "Tests failed. Fix them before committing."
    exit 1
fi

exit 0</code></pre>

            <div class="exercise-box">
                <h4>Exercise: Git Workflow Practice</h4>
                <p><strong>Task:</strong> 1) Create feature branches following GitFlow, 2) Rebase to squash messy commits, 3) Use cherry-pick to backport fix to release branch, 4) Write conventional commit messages throughout.</p>
            </div>
        </section>

        <section id="github-actions" class="devops">
            <h2>11. CI/CD with GitHub Actions</h2>

            <h3>Workflow File Structure</h3>
            <p>Create <code>.github/workflows/ci.yml</code>:</p>
            <pre><code class="yaml-code">name: CI Pipeline

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main, develop]

jobs:
  test:
    runs-on: ubuntu-latest

    strategy:
      matrix:
        php-version: ['8.1', '8.2', '8.3']

    steps:
      - uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ matrix.php-version }}
          extensions: pdo, pdo_mysql, redis
          ini-values: post_max_size=256M

      - name: Cache Composer packages
        uses: actions/cache@v3
        with:
          path: vendor
          key: ${{ runner.os }}-php-${{ matrix.php-version }}-${{ hashFiles('**/composer.lock') }}

      - name: Install dependencies
        run: composer install --prefer-dist

      - name: Lint PHP
        run: |
          ./vendor/bin/php-cs-fixer fix --dry-run
          ./vendor/bin/phpstan analyse

      - name: Run tests
        run: php artisan test --coverage

      - name: Upload coverage
        uses: codecov/codecov-action@v3
        with:
          files: ./coverage.xml</code></pre>

            <h3>Running Tests in Parallel</h3>
            <pre><code class="yaml-code">jobs:
  unit-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - run: composer install
      - run: php artisan test tests/Unit --parallel

  integration-tests:
    runs-on: ubuntu-latest
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_DATABASE: test
          MYSQL_ROOT_PASSWORD: root
        options: >-
          --health-cmd="mysqladmin ping"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=3
        ports:
          - 3306:3306
    steps:
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - run: composer install
      - run: php artisan test tests/Feature</code></pre>

            <h3>Complete CI/CD Pipeline with Deployment</h3>
            <pre><code class="yaml-code">name: Deploy to Production

on:
  push:
    branches: [main]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - run: composer install
      - run: php artisan test

  deploy:
    needs: test
    runs-on: ubuntu-latest
    if: github.ref == 'refs/heads/main'
    steps:
      - uses: actions/checkout@v3
      - uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.DEPLOY_HOST }}
          username: ${{ secrets.DEPLOY_USER }}
          key: ${{ secrets.DEPLOY_KEY }}
          script: |
            cd /var/www/app
            git pull origin main
            composer install --no-dev --optimize-autoloader
            php artisan migrate --force
            php artisan cache:clear
            php artisan config:cache
            php artisan route:cache
            sudo systemctl restart app-queue</code></pre>

            <h3>Useful Actions</h3>
            <table>
                <tr>
                    <th>Action</th>
                    <th>Purpose</th>
                </tr>
                <tr>
                    <td><code>actions/checkout</code></td>
                    <td>Clone repository</td>
                </tr>
                <tr>
                    <td><code>shivammathur/setup-php</code></td>
                    <td>Install PHP with extensions</td>
                </tr>
                <tr>
                    <td><code>actions/cache</code></td>
                    <td>Cache dependencies</td>
                </tr>
                <tr>
                    <td><code>codecov/codecov-action</code></td>
                    <td>Upload coverage reports</td>
                </tr>
                <tr>
                    <td><code>appleboy/ssh-action</code></td>
                    <td>SSH into server for deployment</td>
                </tr>
            </table>

            <div class="warning">
                <strong>Secrets Management:</strong> Never hardcode credentials. Use GitHub Secrets for sensitive data (DB passwords, SSH keys, API tokens).
            </div>

            <div class="exercise-box">
                <h4>Exercise: Complete CI/CD Pipeline</h4>
                <p><strong>Task:</strong> Create a GitHub Actions workflow that: 1) Runs tests on push, 2) Tests multiple PHP versions in parallel, 3) Lints and analyzes code, 4) Uploads coverage, 5) Deploys to staging on PR merge.</p>
            </div>
        </section>

        <section id="linux" class="devops">
            <h2>12. Linux Basics for Backend</h2>

            <h3>Essential Commands</h3>
            <table>
                <tr>
                    <th>Command</th>
                    <th>Purpose</th>
                    <th>Example</th>
                </tr>
                <tr>
                    <td><code>ls</code></td>
                    <td>List files/directories</td>
                    <td><code>ls -la /var/www</code></td>
                </tr>
                <tr>
                    <td><code>cd</code></td>
                    <td>Change directory</td>
                    <td><code>cd /app && pwd</code></td>
                </tr>
                <tr>
                    <td><code>grep</code></td>
                    <td>Search text patterns</td>
                    <td><code>grep "error" app.log</code></td>
                </tr>
                <tr>
                    <td><code>find</code></td>
                    <td>Find files</td>
                    <td><code>find . -name "*.log" -type f</code></td>
                </tr>
                <tr>
                    <td><code>chmod</code></td>
                    <td>Change file permissions</td>
                    <td><code>chmod 755 script.sh</code></td>
                </tr>
                <tr>
                    <td><code>chown</code></td>
                    <td>Change file owner</td>
                    <td><code>chown www-data:www-data /app</code></td>
                </tr>
                <tr>
                    <td><code>ps</code></td>
                    <td>List processes</td>
                    <td><code>ps aux | grep php</code></td>
                </tr>
                <tr>
                    <td><code>kill</code></td>
                    <td>Terminate process</td>
                    <td><code>kill -9 1234</code></td>
                </tr>
                <tr>
                    <td><code>systemctl</code></td>
                    <td>Manage services</td>
                    <td><code>systemctl restart nginx</code></td>
                </tr>
                <tr>
                    <td><code>tail</code></td>
                    <td>View end of file</td>
                    <td><code>tail -f /var/log/app.log</code></td>
                </tr>
            </table>

            <h3>File Permissions (rwx)</h3>
            <pre><code class="bash-code"># Permission format: user | group | others
# Read (r) = 4, Write (w) = 2, Execute (x) = 1

chmod 755 script.sh  # User: rwx (7), Group: r-x (5), Others: r-x (5)
chmod 644 file.txt   # User: rw- (6), Group: r-- (4), Others: r-- (4)
chmod 700 private    # User: rwx (7), Group: --- (0), Others: --- (0)

# For directories:
chmod 755 /var/www   # rwx for user, rx for group/others (can enter)
chmod 700 ~/.ssh     # Only user can enter</code></pre>

            <h3>SSH Key Management</h3>
            <pre><code class="bash-code"># Generate SSH key pair
ssh-keygen -t ed25519 -C "deploy@server"
# Generates: ~/.ssh/id_ed25519 (private) and ~/.ssh/id_ed25519.pub (public)

# Add public key to server
ssh-copy-id -i ~/.ssh/id_ed25519.pub user@server.com

# SSH login without password
ssh -i ~/.ssh/id_ed25519 user@server.com

# Secure SSH config (~/.ssh/config)
Host production
  HostName prod.example.com
  User deploy
  IdentityFile ~/.ssh/id_ed25519</code></pre>

            <h3>Cron Jobs</h3>
            <pre><code class="bash-code"># Edit crontab
crontab -e

# Cron syntax: minute hour day month dayofweek command
# Run Laravel scheduler every minute
* * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1

# Examples:
0 2 * * * /backup.sh          # Daily at 2 AM
*/5 * * * * php /app/check.php # Every 5 minutes
0 0 1 * * /monthly-task.sh     # First day of month
0 0 * * 1 /weekly-task.sh      # Every Monday

# View active crons
crontab -l</code></pre>

            <h3>Systemd Services</h3>
            <pre><code class="bash-code"># Create service file
sudo nano /etc/systemd/system/laravel-queue.service

[Unit]
Description=Laravel Queue Worker
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/app
ExecStart=/usr/bin/php artisan queue:work redis --sleep=3 --tries=3
Restart=always
RestartSec=10

[Install]
WantedBy=multi-user.target

# Enable and start
sudo systemctl enable laravel-queue
sudo systemctl start laravel-queue
sudo systemctl status laravel-queue</code></pre>

            <h3>Log Files</h3>
            <pre><code class="bash-code"># Common log locations
/var/log/syslog          # System logs
/var/log/auth.log        # Authentication logs
/var/log/nginx/access.log # Nginx access
/var/log/nginx/error.log  # Nginx errors
/var/log/php-fpm.log      # PHP-FPM logs

# Monitor logs in real-time
tail -f /var/log/nginx/error.log

# Search logs
grep "GET /api" /var/log/nginx/access.log
grep -i error /var/log/app.log | tail -20</code></pre>

            <div class="exercise-box">
                <h4>Exercise: Linux Server Setup</h4>
                <p><strong>Task:</strong> 1) SSH into a test server, 2) Create appropriate directories with proper permissions, 3) Set up SSH key authentication, 4) Create a cron job for Laravel scheduler, 5) Create a systemd service for queue worker.</p>
            </div>
        </section>

        <section id="nginx" class="devops">
            <h2>13. Nginx Configuration</h2>

            <h3>Server Block (Virtual Host)</h3>
            <pre><code class="yaml-code">server {
    listen 80;
    listen [::]:80;
    server_name example.com www.example.com;

    # Redirect HTTP to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name example.com www.example.com;

    root /var/www/app/public;
    index index.php index.html;

    # SSL certificates
    ssl_certificate /etc/letsencrypt/live/example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/example.com/privkey.pem;

    # ... rest of config
}</code></pre>

            <h3>Location Directives and Routing</h3>
            <pre><code class="yaml-code">server {
    root /var/www/app/public;

    # Exact match (highest priority)
    location = /admin {
        return 403;
    }

    # Prefix match
    location /api {
        # API routes are proxied to PHP
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Regex match (case-sensitive)
    location ~ \.php$ {
        # PHP files are processed by FPM
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Regex match (case-insensitive)
    location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
        # Static files - enable caching
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    # Everything else
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}</code></pre>

            <h3>Reverse Proxy to PHP-FPM</h3>
            <pre><code class="yaml-code">upstream php_upstream {
    server 127.0.0.1:9000;
    server 127.0.0.1:9001;  # Load balance across FPM instances
    keepalive 32;
}

server {
    listen 80;
    server_name app.local;
    root /app/public;

    location ~ \.php$ {
        fastcgi_pass php_upstream;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

        # Improvements
        fastcgi_buffering off;
        fastcgi_request_buffering off;
        fastcgi_keep_conn on;

        include fastcgi_params;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}</code></pre>

            <h3>Gzip Compression</h3>
            <pre><code class="yaml-code">gzip on;
gzip_vary on;
gzip_proxied any;
gzip_comp_level 6;
gzip_types text/plain text/css text/xml text/javascript
           application/json application/javascript application/xml+rss;</code></pre>

            <h3>Security Headers</h3>
            <pre><code class="yaml-code">server {
    # Prevent MIME sniffing
    add_header X-Content-Type-Options "nosniff" always;

    # Enable XSS protection
    add_header X-XSS-Protection "1; mode=block" always;

    # Clickjacking protection
    add_header X-Frame-Options "SAMEORIGIN" always;

    # HSTS (force HTTPS)
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

    # Content Security Policy
    add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'" always;
}</code></pre>

            <h3>Testing Nginx Config</h3>
            <pre><code class="bash-code"># Validate syntax
nginx -t

# Reload without dropping connections
nginx -s reload

# Graceful restart
systemctl reload nginx

# View active config
nginx -T | grep -A 20 "server {"</code></pre>

            <div class="exercise-box">
                <h4>Exercise: Complete Nginx Setup</h4>
                <p><strong>Task:</strong> Create nginx config for a Laravel app with: 1) HTTP → HTTPS redirect, 2) SSL certificates, 3) PHP-FPM reverse proxy, 4) Static file caching, 5) Gzip compression, 6) Security headers, 7) Load balancing across multiple FPM instances.</p>
            </div>
        </section>

        <section id="deployment" class="devops">
            <h2>14. Laravel Deployment</h2>

            <h3>Zero-Downtime Deployment</h3>
            <p>Deploying without interrupting current users:</p>
            <pre><code class="bash-code"># Traditional: Downtime during deployment
git pull
composer install
php artisan migrate
# Site is down during these operations

# Zero-downtime: Use symlinks
# Current structure:
# /var/www/
#   releases/
#     release-2024-01-15/
#     release-2024-01-14/
#   app -> releases/release-2024-01-14

# During deployment:
git pull origin main
composer install
php artisan migrate  # Migrations are backwards compatible
# Atomically switch symlink
ln -sfn releases/release-2024-01-15 app

# If issue, revert instantly:
ln -sfn releases/release-2024-01-14 app</code></pre>

            <h3>Deployer (PHP Deployment Tool)</h3>
            <pre><code class="php-code">// deploy.php
use Deployer as dep;

dep\config()
    ->set('application', 'myapp')
    ->set('repository', 'git@github.com:user/myapp.git')
    ->set('shared_files', ['.env'])
    ->set('shared_dirs', ['storage', 'bootstrap/cache'])
    ->set('writable_dirs', ['storage']);

// Hosts
dep\host('production')
    ->set('hostname', 'prod.example.com')
    ->set('user', 'deploy')
    ->set('deploy_path', '/var/www/app');

// Tasks
dep\task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:run_migrations',
    'deploy:cache_config',
    'deploy:cache_routes',
    'deploy:symlink',
    'deploy:unlock',
])->desc('Deploy application');

dep\task('deploy:run_migrations', function () {
    dep\run('cd {{release_path}} && php artisan migrate --force');
});

// Deploy
// deployer deploy</code></pre>

            <h3>Post-Deployment Commands</h3>
            <p>Run these commands after deploying new code:</p>
            <pre><code class="bash-code"># Migrations (most important)
php artisan migrate --force

# Clear old caches
php artisan cache:clear
php artisan view:clear

# Recache for performance
php artisan config:cache
php artisan route:cache
php artisan event:cache

# Restart background workers
sudo systemctl restart laravel-queue
sudo systemctl restart laravel-scheduler

# Verify deployment
curl https://example.com/api/health</code></pre>

            <h3>Server Requirements</h3>
            <table>
                <tr>
                    <th>Component</th>
                    <th>Requirement</th>
                </tr>
                <tr>
                    <td>PHP</td>
                    <td>8.1+ (8.2+ recommended)</td>
                </tr>
                <tr>
                    <td>Extensions</td>
                    <td>pdo, mbstring, json, bcmath, tokenizer, xml, ctype, fileinfo, filter, hash</td>
                </tr>
                <tr>
                    <td>Web Server</td>
                    <td>Nginx 1.20+ or Apache 2.4+</td>
                </tr>
                <tr>
                    <td>Database</td>
                    <td>MySQL 8.0+ / PostgreSQL 11+ / SQLite 3.8+</td>
                </tr>
                <tr>
                    <td>Cache</td>
                    <td>Redis 5+ or Memcached 1.4+</td>
                </tr>
                <tr>
                    <td>Storage</td>
                    <td>SSD with 20GB+ for app</td>
                </tr>
            </table>

            <h3>Managed Hosting Platforms</h3>
            <ul>
                <li><strong>Laravel Forge:</strong> Server management, zero-downtime deploys, SSL, backups, monitoring</li>
                <li><strong>DigitalOcean App Platform:</strong> Fully managed, auto-scaling, integrated database</li>
                <li><strong>AWS (Elastic Beanstalk):</strong> Auto-scaling, load balancing, managed infrastructure</li>
                <li><strong>Heroku:</strong> Simplest, but more expensive (buildpack approach)</li>
            </ul>

            <div class="key-concept">
                <strong>Backwards-Compatible Migrations:</strong> Write migrations that don't break running instances. Add columns before removing, create new columns before deleting old ones.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Deploy with Zero Downtime</h4>
                <p><strong>Task:</strong> Set up Deployer for a Laravel project with: 1) Symlink-based releases, 2) Shared files/dirs, 3) Automated migrations, 4) Config/route caching, 5) Queue restart. Deploy and verify zero downtime.</p>
            </div>
        </section>

        <section id="monitoring" class="devops">
            <h2>15. Monitoring & Debugging</h2>

            <h3>Laravel Telescope</h3>
            <p>Powerful debugging tool for Laravel applications:</p>
            <pre><code class="bash-code">composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate

# Access at: http://localhost:8000/telescope</code></pre>

            <p>Monitor:</p>
            <ul>
                <li>HTTP requests & responses</li>
                <li>Database queries</li>
                <li>Cache hits/misses</li>
                <li>Jobs & events</li>
                <li>Log entries</li>
                <li>Exceptions</li>
            </ul>

            <h3>Debugbar</h3>
            <pre><code class="bash-code">composer require barryvdh/laravel-debugbar --dev

# Access toolbar at bottom of page in dev</code></pre>

            <p>Shows:</p>
            <ul>
                <li>Execution time</li>
                <li>Memory usage</li>
                <li>Database queries with execution time</li>
                <li>View variables</li>
                <li>Route information</li>
            </ul>

            <h3>Error Tracking (Sentry)</h3>
            <pre><code class="bash-code">composer require sentry/sentry-laravel

# Generate config
php artisan vendor:publish --provider="Sentry\Laravel\ServiceProvider"

# Configure .env
SENTRY_DSN=https://your-key@sentry.io/project-id</code></pre>

            <p>Automatically tracks:</p>
            <ul>
                <li>Exceptions and errors</li>
                <li>Performance issues</li>
                <li>User sessions</li>
                <li>Breadcrumbs (event trail)</li>
            </ul>

            <h3>Detecting N+1 Queries</h3>
            <pre><code class="php-code">// Problem: N+1 query
$users = User::all();
foreach ($users as $user) {
    echo $user->profile->bio; // Executes query for each user!
}

// Solution: Eager load
$users = User::with('profile')->get();
foreach ($users as $user) {
    echo $user->profile->bio; // No extra queries
}

// Detect in Laravel Telescope: View queries tab to spot duplicate patterns</code></pre>

            <h3>APM (Application Performance Monitoring)</h3>
            <p>Tools like Datadog or New Relic monitor:</p>
            <ul>
                <li>Transaction performance</li>
                <li>Database performance</li>
                <li>CPU & memory usage</li>
                <li>Error rates</li>
                <li>Throughput and latency</li>
            </ul>

            <pre><code class="bash-code"># Example: Datadog PHP agent
wget https://github.com/DataDog/dd-trace-php/releases/download/0.89.0/dd-library-php-0.89.0.tar.gz
tar -xf dd-library-php-0.89.0.tar.gz
cp dd-library-php /opt/datadog/

# Configure in php.ini
extension=/opt/datadog/dd_trace.so
datadog.trace.sample_rate=1.0</code></pre>

            <h3>Log Aggregation</h3>
            <p>Centralize logs from all servers:</p>
            <pre><code class="bash-code"># Using ELK Stack (Elasticsearch, Logstash, Kibana)
# Send Laravel logs to Logstash
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single', 'logstash'],
    ],
    'logstash' => [
        'driver' => 'monolog',
        'handler' => \Monolog\Handler\SocketHandler::class,
        'handler_with' => [
            'host' => 'logstash.example.com:5000',
        ],
    ],
]</code></pre>

            <div class="key-concept">
                <strong>Monitoring Strategy:</strong> Combine real-time debugging tools (Telescope, Debugbar) for development with production monitoring (Sentry, Datadog) for catching issues in production.
            </div>

            <div class="exercise-box">
                <h4>Exercise: Complete Monitoring Setup</h4>
                <p><strong>Task:</strong> Set up comprehensive monitoring: 1) Install Telescope and verify it captures requests/queries, 2) Detect and fix N+1 query, 3) Configure Sentry for error tracking, 4) Monitor a slow endpoint and optimize it, 5) Set up Debugbar to profile performance.</p>
            </div>
        </section>

        <footer>
            <p>Testing & DevOps Knowledge Base for PHP/Laravel Backend Developers</p>
            <p>Created for interview preparation and career mastery - Active Recall + Practical Exercises</p>
            <p>Last Updated: 2026-04-08 | Build with confidence!</p>
        </footer>
    </div>

    <script>

        // Collapsible functionality
        document.querySelectorAll('.collapsible').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                    content.style.maxHeight = '0';
                } else {
                    content.classList.add('show');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });

        // Quiz answer reveal
        document.querySelectorAll('.quiz-answer').forEach(answer => {
            answer.addEventListener('click', function() {
                this.style.borderLeft = '3px solid #3fb950';
                this.style.backgroundColor = '#1b3a1f';
                this.style.color = '#3fb950';
            });
        });

        // Smooth scroll for TOC links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    
</script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
lucide.createIcons();
</script>
</body>
</html>

@endverbatim