@verbatim
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Architecture & Design Patterns for PHP/Laravel Developers</title>
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
</style>
</head>
<body>
    <div class="container">

        <div class="top-nav"><a href="/"><i data-lucide="arrow-left"></i> На главную</a></div>
        <header>
            <h1>🏗️ Architecture & Design Patterns</h1>
            <p class="subtitle">for PHP/Laravel Backend Developers</p>
            <p style="color: var(--text-secondary); font-size: 0.95em;">Master SOLID principles, design patterns, and architectural patterns with real-world examples and practical exercises</p>
        </header>

        <div class="toc">
            <h2>📚 Table of Contents</h2>
            <ol>
                <li><a href="#solid">SOLID Principles Deep Dive</a></li>
                <li><a href="#repository">Repository Pattern</a></li>
                <li><a href="#service">Service Layer Pattern</a></li>
                <li><a href="#factory">Factory Pattern</a></li>
                <li><a href="#observer">Observer Pattern</a></li>
                <li><a href="#strategy">Strategy Pattern</a></li>
                <li><a href="#dto">Data Transfer Objects (DTO)</a></li>
                <li><a href="#action">Action Pattern (Single Action Classes)</a></li>
                <li><a href="#di">Dependency Injection Deep Dive</a></li>
                <li><a href="#mvc">MVC and Its Variations</a></li>
                <li><a href="#ddd">Domain-Driven Design Basics</a></li>
                <li><a href="#clean-architecture">Clean Architecture</a></li>
            </ol>
        </div>

        <!-- SOLID Principles -->
        <section id="solid">
            <h2>SOLID Principles Deep Dive</h2>
            <p>SOLID is a set of five design principles that make software more understandable, flexible, and maintainable. These are fundamental to professional software architecture.</p>

            <div class="principle-grid">
                <!-- Single Responsibility -->
                <div class="principle-card">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="principle-letter">S</span>
                        <h4 style="margin: 0;">Single Responsibility</h4>
                    </div>
                    <p><strong>Principle:</strong> A class should have one, and only one, reason to change.</p>
                    <button class="collapsible">📖 Learn More</button>
                    <div class="collapsible-content">
                        <div class="analogy-box">
                            <h4>Real-World Analogy</h4>
                            <p>A restaurant has different roles: chef, waiter, cashier. Each person has one job. If the waiter also cooks and handles payments, they're overwhelmed and mistakes happen.</p>
                        </div>

                        <h4 style="color: var(--accent-blue); margin-top: 15px;">Bad Example</h4>
                        <div class="code-block code-bad">
class UserController {
    public function register() {
        // Validates input
        // Creates user
        // Sends welcome email
        // Logs to audit trail
        // Generates PDF report
    }
}
// WHY BAD: Reasons to change:
// 1. Validation rules change
// 2. User creation logic changes
// 3. Email service changes
// 4. Logging requirements change
// 5. PDF format changes
                        </div>

                        <h4 style="color: var(--accent-green); margin-top: 15px;">Good Example</h4>
                        <div class="code-block code-good">
// RESPONSIBILITY: Handle HTTP requests
class UserController {
    public function __construct(
        private UserRegistrationService $service
    ) {}

    public function register(Request $request) {
        $user = $this->service->register($request->validated());
        return response()->json($user);
    }
}

// RESPONSIBILITY: User registration business logic
class UserRegistrationService {
    public function __construct(
        private UserRepository $repository,
        private EmailService $email
    ) {}

    public function register(array $data): User {
        $user = $this->repository->create($data);
        $this->email->sendWelcome($user);
        return $user;
    }
}

// RESPONSIBILITY: Email notifications
class EmailService {
    public function sendWelcome(User $user) {
        Mail::send(new WelcomeEmail($user));
    }
}
                        </div>

                        <h4 style="color: var(--accent-blue); margin-top: 15px;">Laravel Application</h4>
                        <p>In Laravel, apply SRP by:</p>
                        <ul style="margin-left: 20px; color: var(--text-primary);">
                            <li>Keep controllers thin (just HTTP handling)</li>
                            <li>Extract business logic to Services</li>
                            <li>Use separate classes for queries, commands, events</li>
                            <li>Create specific classes for notifications, exports, validations</li>
                        </ul>
                    </div>
                </div>

                <!-- Open/Closed -->
                <div class="principle-card">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="principle-letter">O</span>
                        <h4 style="margin: 0;">Open/Closed</h4>
                    </div>
                    <p><strong>Principle:</strong> Open for extension, closed for modification. Extend via inheritance/interfaces, not by changing existing code.</p>
                    <button class="collapsible">📖 Learn More</button>
                    <div class="collapsible-content">
                        <div class="analogy-box">
                            <h4>Real-World Analogy</h4>
                            <p>A house's blueprint is closed for modification (you don't rewrite it when adding furniture). But it's open for extension (you can add rooms, decorations, furniture inside). Similarly, code should be stable but extensible.</p>
                        </div>

                        <h4 style="color: var(--accent-red); margin-top: 15px;">Bad Example (Modification-Based)</h4>
                        <div class="code-block code-bad">
class PaymentProcessor {
    public function processPayment($payment, $type) {
        if ($type === 'stripe') {
            return $this->processStripe($payment);
        } elseif ($type === 'paypal') {
            return $this->processPayPal($payment);
        } elseif ($type === 'crypto') {
            return $this->processCrypto($payment);
        }
    }
}
// PROBLEM: Adding new payment type requires modifying this class!
// Every change risks breaking existing code.
                        </div>

                        <h4 style="color: var(--accent-green); margin-top: 15px;">Good Example (Extension-Based)</h4>
                        <div class="code-block code-good">
// CLOSED for modification
interface PaymentGateway {
    public function charge(Money $amount, string $token): PaymentResult;
}

class PaymentProcessor {
    public function __construct(
        private PaymentGateway $gateway
    ) {}

    public function processPayment($payment) {
        return $this->gateway->charge($payment->amount, $payment->token);
    }
}

// OPEN for extension - add new payment types without modifying processor
class StripeGateway implements PaymentGateway {
    public function charge(Money $amount, string $token): PaymentResult {
        // Stripe implementation
    }
}

class PayPalGateway implements PaymentGateway {
    public function charge(Money $amount, string $token): PaymentResult {
        // PayPal implementation
    }
}

// Register in ServiceProvider
$this->app->bind(PaymentGateway::class, StripeGateway::class);
                        </div>
                    </div>
                </div>

                <!-- Liskov Substitution -->
                <div class="principle-card">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="principle-letter">L</span>
                        <h4 style="margin: 0;">Liskov Substitution</h4>
                    </div>
                    <p><strong>Principle:</strong> Subtypes must be substitutable for their base types without breaking code.</p>
                    <button class="collapsible">📖 Learn More</button>
                    <div class="collapsible-content">
                        <div class="analogy-box">
                            <h4>Real-World Analogy</h4>
                            <p>If you expect a "Vehicle" with a "drive()" method, any subtype (Car, Truck, Bus) must work the same way. You shouldn't get a flying vehicle when you expect a ground vehicle.</p>
                        </div>

                        <h4 style="color: var(--accent-red); margin-top: 15px;">Bad Example (Violated LSP)</h4>
                        <div class="code-block code-bad">
class Rectangle {
    protected $width, $height;

    public function setWidth($w) { $this->width = $w; }
    public function setHeight($h) { $this->height = $h; }

    public function area() {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle {
    // Square forces width == height
    public function setWidth($w) {
        $this->width = $w;
        $this->height = $w;  // Force equality
    }
}

// PROBLEM CODE
$shape = new Square();
$shape->setWidth(5);
$shape->setHeight(3);  // Sets height to 3, but constructor forces width to 3!
echo $shape->area();  // Outputs 9, not 15! Contract violated!
                        </div>

                        <h4 style="color: var(--accent-green); margin-top: 15px;">Good Example (LSP Satisfied)</h4>
                        <div class="code-block code-good">
// Don't force Square to be a Rectangle
interface Shape {
    public function area(): float;
}

class Rectangle implements Shape {
    public function __construct(
        private float $width,
        private float $height
    ) {}

    public function area(): float {
        return $this->width * $this->height;
    }
}

class Square implements Shape {
    public function __construct(
        private float $side
    ) {}

    public function area(): float {
        return $this->side * $this->side;
    }
}

// Now this works predictably
$shapes = [
    new Rectangle(5, 3),
    new Square(5)
];

foreach ($shapes as $shape) {
    echo $shape->area();  // Safe to use polymorphically
}
                        </div>
                    </div>
                </div>

                <!-- Interface Segregation -->
                <div class="principle-card">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="principle-letter">I</span>
                        <h4 style="margin: 0;">Interface Segregation</h4>
                    </div>
                    <p><strong>Principle:</strong> Clients should not depend on methods they don't use. Create small, focused interfaces.</p>
                    <button class="collapsible">📖 Learn More</button>
                    <div class="collapsible-content">
                        <div class="analogy-box">
                            <h4>Real-World Analogy</h4>
                            <p>You don't need a universal remote that controls everything (lights, TV, sound, heating). A user only cares about specific buttons. One remote per device is simpler.</p>
                        </div>

                        <h4 style="color: var(--accent-red); margin-top: 15px;">Bad Example (Fat Interface)</h4>
                        <div class="code-block code-bad">
interface UserInterface {
    public function authenticate();
    public function authorize();
    public function updateProfile();
    public function createReport();
    public function sendEmail();
    public function generateInvoice();
    public function calculateTaxes();
    public function exportPDF();
    public function importData();
    public function deleteUser();
    public function logActivity();
    public function cacheData();
    // ... 20+ methods!
}

class AdminUser implements UserInterface {
    // Must implement ALL methods, even if not needed
}
                        </div>

                        <h4 style="color: var(--accent-green); margin-top: 15px;">Good Example (Focused Interfaces)</h4>
                        <div class="code-block code-good">
interface Authenticatable {
    public function authenticate();
}

interface Authorizable {
    public function authorize(string $permission): bool;
}

interface HasRoles {
    public function assignRole(string $role);
    public function hasRole(string $role): bool;
}

interface CanExport {
    public function exportPDF(): string;
    public function exportCSV(): string;
}

class User implements Authenticatable, Authorizable, HasRoles {
    // Only implements what this user actually does
}

class ReadOnlyUser implements Authenticatable {
    // Minimal interface, minimal implementation
}

class ReportGenerator implements CanExport {
    // Focused on export responsibility
}
                        </div>
                    </div>
                </div>

                <!-- Dependency Inversion -->
                <div class="principle-card">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="principle-letter">D</span>
                        <h4 style="margin: 0;">Dependency Inversion</h4>
                    </div>
                    <p><strong>Principle:</strong> Depend on abstractions, not on concrete implementations. High-level modules should not depend on low-level modules.</p>
                    <button class="collapsible">📖 Learn More</button>
                    <div class="collapsible-content">
                        <div class="analogy-box">
                            <h4>Real-World Analogy</h4>
                            <p>An electrical appliance shouldn't be hardwired to one power plant. Instead, it plugs into a standardized socket (abstraction). You can swap the power source without changing the appliance.</p>
                        </div>

                        <h4 style="color: var(--accent-red); margin-top: 15px;">Bad Example (Concrete Dependency)</h4>
                        <div class="code-block code-bad">
class OrderService {
    public function __construct() {
        // TIGHTLY COUPLED to concrete class!
        $this->payment = new StripePaymentProcessor();
        $this->notifier = new EmailNotifier();
    }

    public function createOrder(Order $order) {
        $this->payment->process($order);  // Hard to test, can't swap
        $this->notifier->send($order);
    }
}
// Problem: Can't use PayPal without rewriting OrderService
// Problem: Can't mock in tests
                        </div>

                        <h4 style="color: var(--accent-green); margin-top: 15px;">Good Example (Abstract Dependency)</h4>
                        <div class="code-block code-good">
interface PaymentProcessor {
    public function process(Order $order): PaymentResult;
}

interface Notifier {
    public function send(Order $order): void;
}

class OrderService {
    public function __construct(
        private PaymentProcessor $payment,  // Depend on abstraction
        private Notifier $notifier
    ) {}

    public function createOrder(Order $order) {
        $this->payment->process($order);
        $this->notifier->send($order);
    }
}

// Can inject ANY implementation
$orderService = new OrderService(
    new StripePaymentProcessor(),
    new EmailNotifier()
);

// Or in tests:
$orderService = new OrderService(
    new MockPaymentProcessor(),
    new MockNotifier()
);

// Register in ServiceProvider
$this->app->bind(PaymentProcessor::class, StripePaymentProcessor::class);
$this->app->bind(Notifier::class, EmailNotifier::class);
                        </div>
                    </div>
                </div>
            </div>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q1: Which SOLID principle suggests breaking a large interface into smaller ones?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> Interface Segregation Principle (I). Fat interfaces force implementations to depend on methods they don't use.
                    </div>
                </div>
                <div class="quiz-question">
                    <strong>Q2: How do SOLID principles relate to testing?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> By depending on abstractions (DIP), you can inject mocks. By separating concerns (SRP), each class is easier to test. By following OCP, you extend behavior without modifying tested code.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Take a Laravel controller that violates multiple SOLID principles and refactor it:</p>
                <p>1. Extract business logic to Service (SRP)</p>
                <p>2. Create PaymentInterface for different payment methods (OCP, DIP)</p>
                <p>3. Split a fat interface into focused ones (ISP)</p>
                <p>Compare how testable and maintainable the code becomes.</p>
            </div>

            <div class="reference-box">
                <h4>📖 References</h4>
                <p><strong>Books:</strong> Clean Code (Robert Martin), Design Patterns (Gang of Four)</p>
                <p><strong>Web:</strong> Martin Fowler's Architecture guides, Clean Architecture blog posts</p>
            </div>
        </section>

        <!-- Repository Pattern -->
        <section id="repository">
            <h2>Repository Pattern</h2>
            <p>The Repository pattern creates an abstraction layer between your business logic and data access layer. It centralizes data retrieval logic and makes it easy to switch data sources without changing business logic.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A library's card catalog (repository) lists all books. A librarian doesn't care if books are on physical shelves, in a warehouse, or borrowed from another library. The interface stays the same.</p>
            </div>

            <h3>Structure</h3>
            <div class="diagram">
┌─────────────────────┐
│    Controller       │
│   (HTTP layer)      │
└──────────┬──────────┘
           │ uses
           ▼
┌─────────────────────┐
│   Service Layer     │
│  (Business logic)   │
└──────────┬──────────┘
           │ uses
           ▼
┌─────────────────────┐
│  RepositoryInterface│
│   (Abstraction)     │
└──────────┬──────────┘
           │ implemented by
           ▼
┌─────────────────────┐
│ EloquentRepository  │
│  (Concrete impl)    │
└──────────┬──────────┘
           │ uses
           ▼
┌─────────────────────┐
│ Eloquent Model      │
│  (Database access)  │
└─────────────────────┘
            </div>

            <h3>Full Laravel Implementation</h3>
            <div class="code-block code-good">
// 1. Define the interface
interface UserRepository {
    public function find(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function all(): Collection;
    public function create(array $data): User;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

// 2. Implement with Eloquent
class EloquentUserRepository implements UserRepository {
    public function __construct(
        private User $model
    ) {}

    public function find(int $id): ?User {
        return $this->model->find($id);
    }

    public function findByEmail(string $email): ?User {
        return $this->model->where('email', $email)->first();
    }

    public function all(): Collection {
        return $this->model->all();
    }

    public function create(array $data): User {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id): bool {
        return $this->model->destroy($id) > 0;
    }
}

// 3. Use in Service
class UserService {
    public function __construct(
        private UserRepository $repository
    ) {}

    public function registerUser(array $data): User {
        // Business logic
        $data['email_verified_at'] = now();
        return $this->repository->create($data);
    }
}

// 4. Register in ServiceProvider
class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );
    }
}

// 5. Use in Controller
class AuthController extends Controller {
    public function __construct(
        private UserService $service
    ) {}

    public function register(Request $request) {
        $user = $this->service->registerUser($request->validated());
        return response()->json($user);
    }
}
            </div>

            <h3>When to Use Repository Pattern</h3>
            <table>
                <thead>
                    <tr>
                        <th>✓ USE Repository When</th>
                        <th>✗ Repository is Overkill</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Multiple data sources (DB, API, cache)</td>
                        <td>Simple CRUD app with one data source</td>
                    </tr>
                    <tr>
                        <td>Need to mock data access in tests</td>
                        <td>Using Laravel's testing helpers (factories, mocking)</td>
                    </tr>
                    <tr>
                        <td>Complex query logic</td>
                        <td>Simple Eloquent queries in controller</td>
                    </tr>
                    <tr>
                        <td>Switching databases is possible</td>
                        <td>Locked into one database forever</td>
                    </tr>
                    <tr>
                        <td>Team project needs consistency</td>
                        <td>Solo small scripts</td>
                    </tr>
                </tbody>
            </table>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q: Why define an interface instead of directly injecting the Eloquent model?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> The interface allows you to swap implementations without changing the service. You can test with a mock repository, switch to a cached repository, or change from Eloquent to an API data source.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create a ProductRepository with interface and Eloquent implementation. Include methods: findById, findByCategory, search, create, update, delete. Write a ProductService that uses it. Create a test that mocks the repository.</p>
            </div>
        </section>

        <!-- Service Layer Pattern -->
        <section id="service">
            <h2>Service Layer Pattern</h2>
            <p>The Service Layer encapsulates business logic separate from HTTP concerns. This layer contains use-case specific logic and orchestrates repositories, validators, and external services.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A restaurant's kitchen (service layer) receives orders from waiters (controller). The kitchen handles cooking, timing, quality checks, and plating. Waiters never go into the kitchen.</p>
            </div>

            <h3>Anatomy of a Service</h3>
            <div class="code-block code-good">
class OrderService {
    public function __construct(
        private OrderRepository $orders,
        private ProductRepository $products,
        private PaymentProcessor $payment,
        private InventoryService $inventory,
        private NotificationService $notifier
    ) {}

    public function createOrder(OrderDTO $orderData): Order {
        // 1. Validate business rules
        if (!$this->inventory->hasStock($orderData->productId, $orderData->quantity)) {
            throw new OutOfStockException();
        }

        // 2. Calculate totals
        $product = $this->products->find($orderData->productId);
        $totalPrice = $this->calculateTotal($product, $orderData->quantity);

        // 3. Process payment
        $paymentResult = $this->payment->charge($orderData->paymentToken, $totalPrice);
        if (!$paymentResult->successful) {
            throw new PaymentFailedException($paymentResult->message);
        }

        // 4. Create order in database
        $order = $this->orders->create([
            'user_id' => $orderData->userId,
            'product_id' => $orderData->productId,
            'quantity' => $orderData->quantity,
            'total_price' => $totalPrice,
            'payment_id' => $paymentResult->id,
        ]);

        // 5. Update inventory
        $this->inventory->decreaseStock($orderData->productId, $orderData->quantity);

        // 6. Send notifications
        $this->notifier->sendOrderConfirmation($order);
        $this->notifier->notifyInventory('low-stock', $product->id);

        // 7. Return domain object
        return $order;
    }

    private function calculateTotal(Product $product, int $quantity): float {
        return $product->price * $quantity;
    }
}

// Controller: Just HTTP handling
class OrderController extends Controller {
    public function __construct(
        private OrderService $service
    ) {}

    public function store(CreateOrderRequest $request) {
        try {
            $orderData = OrderDTO::from($request->validated());
            $order = $this->service->createOrder($orderData);
            return response()->json($order, 201);
        } catch (OutOfStockException $e) {
            return response()->json(['error' => 'Out of stock'], 400);
        }
    }
}
            </div>

            <h3>Service vs Repository vs Model: Responsibility Chart</h3>
            <table>
                <thead>
                    <tr>
                        <th>Responsibility</th>
                        <th>Model</th>
                        <th>Repository</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Database queries</td>
                        <td>Define relationships</td>
                        <td>Execute queries</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Business rules</td>
                        <td>Validation only</td>
                        <td>No</td>
                        <td>Complex logic</td>
                    </tr>
                    <tr>
                        <td>Data transformation</td>
                        <td>Casting/attributes</td>
                        <td>Map to DTOs</td>
                        <td>Apply business rules</td>
                    </tr>
                    <tr>
                        <td>External API calls</td>
                        <td>No</td>
                        <td>No</td>
                        <td>Yes (payment, email)</td>
                    </tr>
                    <tr>
                        <td>Transactions</td>
                        <td>No</td>
                        <td>No</td>
                        <td>Orchestrate with DB</td>
                    </tr>
                </tbody>
            </table>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q: Where should you put the logic: "Check if product is in stock"?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> In a Service (OrderService or InventoryService). The Model can have a method like `isOutOfStock()` for simple checks, but orchestration of business workflows belongs in Services.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create a UserInvitationService that handles sending invites. Include: validation, duplicate checking, rate limiting, email sending, audit logging. Use Repository for data access, external service for email. Make it fully testable.</p>
            </div>
        </section>

        <!-- Factory Pattern -->
        <section id="factory">
            <h2>Factory Pattern</h2>
            <p>The Factory pattern creates objects without specifying exact classes. It abstracts object creation and is useful when creation logic is complex or when the type varies at runtime.</p>

            <h3>Three Types of Factory</h3>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">1. Simple Factory</h4>
            <div class="code-block code-good">
interface Notification {
    public function send(): bool;
}

class EmailNotification implements Notification {
    public function send(): bool { /* */ }
}

class SmsNotification implements Notification {
    public function send(): bool { /* */ }
}

class NotificationFactory {
    public static function make(string $type): Notification {
        return match($type) {
            'email' => new EmailNotification(),
            'sms' => new SmsNotification(),
            'slack' => new SlackNotification(),
            default => throw new InvalidNotificationTypeException()
        };
    }
}

// Usage
$notification = NotificationFactory::make('email');
$notification->send();
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">2. Factory Method (with Inheritance)</h4>
            <div class="code-block code-good">
abstract class PaymentGatewayFactory {
    abstract public function createGateway(): PaymentGateway;

    public function processPayment(Money $amount) {
        $gateway = $this->createGateway();
        return $gateway->charge($amount);
    }
}

class StripeFactory extends PaymentGatewayFactory {
    public function createGateway(): PaymentGateway {
        return new StripeGateway(config('services.stripe.key'));
    }
}

class PayPalFactory extends PaymentGatewayFactory {
    public function createGateway(): PaymentGateway {
        return new PayPalGateway(config('services.paypal.key'));
    }
}

// Usage
$factory = app()->make(config('payment.gateway') . 'Factory');
$factory->processPayment($amount);
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">3. Abstract Factory (Complex Object Creation)</h4>
            <div class="code-block code-good">
interface ExportFactory {
    public function createFormatter(): ExportFormatter;
    public function createWriter(): ExportWriter;
}

class PdfExportFactory implements ExportFactory {
    public function createFormatter(): ExportFormatter {
        return new PdfFormatter();
    }

    public function createWriter(): ExportWriter {
        return new PdfWriter();
    }
}

class ExcelExportFactory implements ExportFactory {
    public function createFormatter(): ExportFormatter {
        return new ExcelFormatter();
    }

    public function createWriter(): ExportWriter {
        return new ExcelWriter();
    }
}

class ReportExporter {
    public function export(ExportFactory $factory, array $data): string {
        $formatter = $factory->createFormatter();
        $writer = $factory->createWriter();

        $formatted = $formatter->format($data);
        return $writer->write($formatted);
    }
}

// Usage
$factory = match(request('format')) {
    'pdf' => new PdfExportFactory(),
    'excel' => new ExcelExportFactory(),
};

$exporter = new ReportExporter();
return $exporter->export($factory, $reportData);
            </div>

            <h3>Laravel Model Factories</h3>
            <p>Laravel provides factories for testing data creation:</p>
            <div class="code-block code-good">
// database/factories/UserFactory.php
class UserFactory extends Factory {
    public function definition(): array {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ];
    }

    public function unverified(): static {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

// Usage in tests
$user = User::factory()->create();
$users = User::factory()->count(10)->create();
$unverified = User::factory()->unverified()->create();
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create a DiscountFactory that generates different discount strategies (PercentageDiscount, FixedAmountDiscount, BuyOneGetOne). Use it in a CartService to apply discounts based on configuration.</p>
            </div>
        </section>

        <!-- Observer Pattern -->
        <section id="observer">
            <h2>Observer Pattern</h2>
            <p>The Observer pattern defines a one-to-many relationship where when one object (subject) changes state, all observers are notified automatically. Laravel implements this with Observers and Events.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A magazine publishes an article. All subscribers are notified automatically. The magazine doesn't need to know who each subscriber is.</p>
            </div>

            <h3>Laravel Model Observers</h3>
            <div class="code-block code-good">
// Create observer
class UserObserver {
    public function created(User $user): void {
        // After user is created
        Log::info("User created: {$user->email}");
        Mail::send(new WelcomeEmail($user));
    }

    public function updated(User $user): void {
        // After user is updated
        AuditLog::create([
            'model' => 'User',
            'action' => 'updated',
            'user_id' => $user->id,
            'changes' => $user->getChanges(),
        ]);
    }

    public function deleted(User $user): void {
        // After user is deleted
        Log::warning("User deleted: {$user->email}");
        // Archive user data, cleanup
    }

    public function restoring(User $user): void {
        // Before soft-deleted user is restored
    }

    public function restored(User $user): void {
        // After user is restored
    }
}

// Register in AppServiceProvider
class AppServiceProvider extends ServiceProvider {
    public function boot(): void {
        User::observe(UserObserver::class);
    }
}
            </div>

            <h3>Events vs Observers</h3>
            <table>
                <thead>
                    <tr>
                        <th>Observer</th>
                        <th>Event</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tied to Model lifecycle</td>
                        <td>Can fire from anywhere</td>
                    </tr>
                    <tr>
                        <td>Simple, automatic</td>
                        <td>More flexible, explicit</td>
                    </tr>
                    <tr>
                        <td>Limited hooks (created, updated, deleted)</td>
                        <td>Custom events for business logic</td>
                    </tr>
                    <tr>
                        <td>Good for: audit logging, sync operations</td>
                        <td>Good for: notifications, complex workflows</td>
                    </tr>
                </tbody>
            </table>

            <h3>Using Events for Business Logic</h3>
            <div class="code-block code-good">
// Define custom event
class OrderCreated {
    public function __construct(
        public Order $order
    ) {}
}

// Fire event from Service
class OrderService {
    public function createOrder(OrderDTO $data): Order {
        $order = Order::create($data->toArray());

        // Fire event - observers will handle consequences
        event(new OrderCreated($order));

        return $order;
    }
}

// Handle event with listener
class SendOrderConfirmationEmail {
    public function handle(OrderCreated $event): void {
        Mail::send(new OrderConfirmation($event->order));
    }
}

class UpdateInventory {
    public function handle(OrderCreated $event): void {
        // Update stock based on order
    }
}

class LogOrderCreation {
    public function handle(OrderCreated $event): void {
        Log::info("Order #{$event->order->id} created");
    }
}

// Register listeners in EventServiceProvider
protected $listen = [
    OrderCreated::class => [
        SendOrderConfirmationEmail::class,
        UpdateInventory::class,
        LogOrderCreation::class,
    ],
];
            </div>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q: When is Observer better than Event for Model changes?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> When you need simple lifecycle hooks (audit logs, cascading deletes). Events are better when you need custom business events that don't align with lifecycle hooks.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create a Post model with an Observer that: creates a slug on creation, updates full-text search index on update, archives comments on deletion. Also create a custom PostPublished event with listeners for notifications and analytics.</p>
            </div>
        </section>

        <!-- Strategy Pattern -->
        <section id="strategy">
            <h2>Strategy Pattern</h2>
            <p>The Strategy pattern encapsulates interchangeable algorithms into separate classes. The client can switch algorithms at runtime without changing code.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A courier can deliver packages using different strategies: truck, plane, or bicycle. The customer doesn't care which strategy is used—it should arrive. The strategy is chosen based on distance and urgency.</p>
            </div>

            <h3>Payment Processing Example</h3>
            <div class="code-block code-good">
interface PaymentStrategy {
    public function charge(Money $amount, PaymentDetails $details): PaymentResult;
    public function refund(string $transactionId, Money $amount): bool;
    public function supportsRecurring(): bool;
}

class StripePayment implements PaymentStrategy {
    public function charge(Money $amount, PaymentDetails $details): PaymentResult {
        $stripe = new \Stripe\StripeClient(config('services.stripe.key'));
        $result = $stripe->charges->create([
            'amount' => $amount->inCents(),
            'currency' => $amount->currency,
            'source' => $details->token,
        ]);
        return new PaymentResult(true, $result->id);
    }

    public function refund(string $transactionId, Money $amount): bool {
        // Stripe refund logic
    }

    public function supportsRecurring(): bool {
        return true;
    }
}

class PayPalPayment implements PaymentStrategy {
    public function charge(Money $amount, PaymentDetails $details): PaymentResult {
        // PayPal API call
    }

    public function refund(string $transactionId, Money $amount): bool {
        // PayPal refund
    }

    public function supportsRecurring(): bool {
        return true;
    }
}

class CryptoPayment implements PaymentStrategy {
    public function charge(Money $amount, PaymentDetails $details): PaymentResult {
        // Crypto payment processing
    }

    public function refund(string $transactionId, Money $amount): bool {
        return false;  // Crypto is irreversible
    }

    public function supportsRecurring(): bool {
        return false;
    }
}

// Context class
class PaymentProcessor {
    public function __construct(
        private PaymentStrategy $strategy
    ) {}

    public function processPayment(Money $amount, PaymentDetails $details): PaymentResult {
        return $this->strategy->charge($amount, $details);
    }

    public function processRefund(string $transactionId, Money $amount): bool {
        return $this->strategy->refund($transactionId, $amount);
    }
}

// Usage
$strategy = match(request('payment_method')) {
    'stripe' => new StripePayment(),
    'paypal' => new PayPalPayment(),
    'crypto' => new CryptoPayment(),
};

$processor = new PaymentProcessor($strategy);
$result = $processor->processPayment($amount, $details);
            </div>

            <h3>Export Strategies</h3>
            <div class="code-block code-good">
interface ExportStrategy {
    public function export(array $data): string;
    public function getContentType(): string;
}

class PdfExportStrategy implements ExportStrategy {
    public function export(array $data): string {
        return PDF::loadHTML($this->renderHtml($data))->output();
    }

    public function getContentType(): string {
        return 'application/pdf';
    }
}

class CsvExportStrategy implements ExportStrategy {
    public function export(array $data): string {
        return implode("\n", array_map(fn($row) => implode(',', $row), $data));
    }

    public function getContentType(): string {
        return 'text/csv';
    }
}

class JsonExportStrategy implements ExportStrategy {
    public function export(array $data): string {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function getContentType(): string {
        return 'application/json';
    }
}

// Use in controller
class ReportController {
    public function export(Request $request) {
        $strategy = match($request->query('format')) {
            'pdf' => new PdfExportStrategy(),
            'csv' => new CsvExportStrategy(),
            default => new JsonExportStrategy(),
        };

        $data = Report::getLatest()->toArray();
        $content = $strategy->export($data);

        return response($content, 200, [
            'Content-Type' => $strategy->getContentType(),
        ]);
    }
}
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create sorting strategies (SortByNameStrategy, SortByDateStrategy, SortByRelevanceStrategy). Use them in a SearchService to allow users to choose how results are sorted without changing search logic.</p>
            </div>
        </section>

        <!-- DTO Pattern -->
        <section id="dto">
            <h2>Data Transfer Objects (DTO)</h2>
            <p>DTOs are simple objects that carry data between processes. They prevent tight coupling between layers and provide a clear contract for what data a function expects.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A customs form is a DTO—it defines exactly what information must be provided in a standardized format, regardless of how that information is used internally.</p>
            </div>

            <h3>Why Not Pass Request to Service?</h3>
            <div class="code-block code-bad">
// BAD: Service depends on HTTP Request
class UserService {
    public function register(Request $request): User {
        $data = $request->validated();
        return User::create($data);
    }
}

// Problems:
// 1. Service is tightly coupled to HTTP layer
// 2. Can't test without mocking Request
// 3. Request contains unneeded data
// 4. If HTTP format changes, service breaks
            </div>

            <h3>Using DTOs</h3>
            <div class="code-block code-good">
// Simple DTO with readonly properties
readonly class RegisterUserDTO {
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    // Construct from Request
    public static function fromRequest(Request $request): self {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}

// Service works with DTO, not Request
class UserService {
    public function register(RegisterUserDTO $dto): User {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
        ]);
    }
}

// Controller: Create DTO from Request
class RegisterController extends Controller {
    public function __construct(
        private UserService $service
    ) {}

    public function store(Request $request) {
        $dto = RegisterUserDTO::fromRequest($request);
        $user = $this->service->register($dto);
        return response()->json($user, 201);
    }
}
            </div>

            <h3>Using Spatie Laravel-Data Package</h3>
            <div class="code-block code-good">
use Spatie\LaravelData\Data;

class OrderData extends Data {
    public function __construct(
        public int $productId,
        public int $quantity,
        public string $shippingAddress,
    ) {}
}

class OrderService {
    public function createOrder(OrderData $data): Order {
        // Type-safe access
        return Order::create([
            'product_id' => $data->productId,
            'quantity' => $data->quantity,
            'shipping_address' => $data->shippingAddress,
        ]);
    }
}

// Automatic casting from Request
$order = $this->service->createOrder(
    OrderData::from($request->validated())
);

// Serialize to JSON automatically
$orderData = OrderData::from($order);
return response()->json($orderData);  // Auto-serializes
            </div>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q: When should you create a DTO vs passing an array?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> Use DTOs when: data has structure/validation, multiple functions accept it, you want IDE autocomplete, you need to transform data. Use arrays for simple, one-off data.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create CreateProductDTO and UpdateProductDTO with validation. Use them in ProductService. Implement serialization for API responses. Test that DTOs prevent invalid data from entering the service.</p>
            </div>
        </section>

        <!-- Action Pattern -->
        <section id="action">
            <h2>Action Pattern (Single Action Classes)</h2>
            <p>One class = one use case. Actions are lightweight classes representing a single business action. They're simpler than services and great for reusable, testable business logic.</p>

            <div class="analogy-box">
                <h4>Real-World Analogy</h4>
                <p>A toolbox has many tools, each doing one job perfectly: hammer, screwdriver, wrench. You don't have a universal tool that does everything.</p>
            </div>

            <h3>Service vs Action</h3>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Multiple related use cases</td>
                        <td>Single use case</td>
                    </tr>
                    <tr>
                        <td>UserService: register, updateProfile, delete</td>
                        <td>RegisterUserAction, UpdateProfileAction</td>
                    </tr>
                    <tr>
                        <td>Larger, stateful</td>
                        <td>Small, focused</td>
                    </tr>
                    <tr>
                        <td>Used by multiple controllers</td>
                        <td>Often one controller method</td>
                    </tr>
                </tbody>
            </table>

            <h3>Implementation</h3>
            <div class="code-block code-good">
// Simple action
class CreateOrderAction {
    public function __construct(
        private OrderRepository $orders,
        private PaymentProcessor $payment,
        private InventoryService $inventory,
        private NotificationService $notifier,
    ) {}

    public function execute(CreateOrderDTO $dto): Order {
        // Validate stock
        if (!$this->inventory->hasStock($dto->productId, $dto->quantity)) {
            throw new OutOfStockException();
        }

        // Process payment
        $paymentResult = $this->payment->charge(
            $dto->totalPrice,
            $dto->paymentToken
        );

        if (!$paymentResult->successful) {
            throw new PaymentFailedException();
        }

        // Create order
        $order = $this->orders->create($dto->toArray());

        // Update inventory
        $this->inventory->decreaseStock($dto->productId, $dto->quantity);

        // Notify
        $this->notifier->sendConfirmation($order);

        return $order;
    }
}

// Another action
class SendInvoiceAction {
    public function __construct(
        private InvoiceGenerator $generator,
        private MailService $mail,
    ) {}

    public function execute(Order $order): void {
        $invoice = $this->generator->generate($order);
        $this->mail->send($order->customer->email, $invoice);
    }
}

// Use in controller
class OrderController extends Controller {
    public function store(
        Request $request,
        CreateOrderAction $action
    ) {
        $dto = CreateOrderDTO::from($request->validated());
        $order = $action->execute($dto);
        return response()->json($order, 201);
    }
}

// Use in console
class SendInvoiceCommand extends Command {
    public function __construct(
        private SendInvoiceAction $action
    ) {
        parent::__construct();
    }

    public function handle() {
        Order::pending()->each(fn($order) => $this->action->execute($order));
    }
}
            </div>

            <h3>Laravel Actions Package</h3>
            <div class="code-block code-good">
// Using Loris Leiva's Laravel Actions package
use Loris\Actions\Concerns\AsAction;

class CreateOrderAction {
    use AsAction;

    public function handle(CreateOrderDTO $dto): Order {
        // Business logic
    }

    // Auto-registers in container
    // Can be called as: CreateOrderAction::run($dto)
    // Can be dispatched: dispatch(new CreateOrderAction($dto))
    // Can be queued: dispatch(new CreateOrderAction($dto))->onQueue('orders')
}

// Usage
// From controller: $order = CreateOrderAction::run($dto);
// Queued: CreateOrderAction::dispatch($dto)->delay(now()->addMinute());
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create RegisterUserAction, SendWelcomeEmailAction, LogAuditAction. Chain them in RegisterController. Make them reusable from console command and queued job. Test each action independently.</p>
            </div>
        </section>

        <!-- Dependency Injection -->
        <section id="di">
            <h2>Dependency Injection Deep Dive</h2>
            <p>Dependency Injection is the practice of providing objects with their dependencies rather than having them create dependencies themselves. This enables testability, flexibility, and loose coupling.</p>

            <h3>Three Types of Injection</h3>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">1. Constructor Injection (Most Common)</h4>
            <div class="code-block code-good">
class OrderService {
    // Dependencies declared in constructor
    public function __construct(
        private OrderRepository $repository,
        private PaymentProcessor $payment,
        private NotificationService $notifier,
    ) {}

    public function createOrder($data) {
        // Use injected dependencies
        $order = $this->repository->create($data);
        $this->payment->process($order);
        $this->notifier->send($order);
        return $order;
    }
}

// Laravel's container auto-resolves:
$service = app(OrderService::class);  // Container creates all dependencies
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">2. Method Injection</h4>
            <div class="code-block code-good">
class OrderController extends Controller {
    // In route handlers, Laravel injects dependencies
    public function store(
        Request $request,
        OrderService $service  // Injected by container
    ) {
        $order = $service->createOrder($request->validated());
        return response()->json($order);
    }
}

// Also works in middleware, commands, jobs
class OrderNotificationMiddleware {
    public function handle(Request $request, Closure $next, NotificationService $notifier) {
        // $notifier is injected
    }
}
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">3. Property Injection (Not Recommended)</h4>
            <div class="code-block code-bad">
class OrderService {
    public OrderRepository $repository;  // Set from outside

    // Problem: Dependencies not clear
    // Problem: Object is incomplete until properties are set
}

// Avoid this pattern - constructor or method injection is better
            </div>

            <h3>Service Container Binding</h3>
            <div class="code-block code-good">
// Simple binding: interface → implementation
$this->app->bind(
    PaymentProcessor::class,
    StripePaymentProcessor::class
);

// Now when you inject PaymentProcessor, get Stripe implementation
$service = new OrderService(
    app(PaymentProcessor::class)  // Returns StripePaymentProcessor
);

// Singleton: only one instance for entire app
$this->app->singleton(
    CacheStore::class,
    RedisCache::class
);

// Factory: create new instance each time with custom logic
$this->app->bind(DatabaseConnection::class, function ($app) {
    return new DatabaseConnection(
        config('database.default'),
        config('database.connections')
    );
});

// Bind instance directly
$logger = new Logger();
$this->app->instance(Logger::class, $logger);
            </div>

            <h3>Auto-Resolution</h3>
            <div class="code-block code-good">
// Laravel's container can auto-resolve even without explicit binding!
class UserService {
    public function __construct(
        UserRepository $repository,  // Container creates this
        EmailService $email,         // Container creates this
    ) {}
}

// Container uses reflection to see constructor parameters
// If no binding exists, it creates default instance
$service = app(UserService::class);  // Works automatically!

// BUT: Only works with class type-hints, not interfaces
// For interfaces, you must bind explicitly
            </div>

            <h3>Why DI Matters for Testing</h3>
            <div class="code-block code-good">
// WITH Dependency Injection: Easy to test
class OrderServiceTest extends TestCase {
    public function test_creates_order() {
        $mockRepository = Mockery::mock(OrderRepository::class);
        $mockPayment = Mockery::mock(PaymentProcessor::class);
        $mockNotifier = Mockery::mock(NotificationService::class);

        // Inject mocks
        $service = new OrderService($mockRepository, $mockPayment, $mockNotifier);

        // Test with mocked dependencies
        $result = $service->createOrder([...]);

        $this->assertTrue($result->success);
    }
}

// WITHOUT Dependency Injection: Difficult to test
class OrderServiceWithoutDI {
    public function createOrder($data) {
        $repository = new EloquentOrderRepository();  // HARDCODED!
        $payment = new StripePaymentProcessor();      // HARDCODED!
        // Can't mock, must use real classes
    }
}
            </div>

            <h3>Service Provider Binding</h3>
            <div class="code-block code-good">
// app/Providers/AppServiceProvider.php
class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        // Register bindings
        $this->app->bind(
            PaymentProcessor::class,
            StripePaymentProcessor::class
        );

        $this->app->bind(
            NotificationService::class,
            EmailNotificationService::class
        );
    }

    public function boot(): void {
        // Boot applications services
    }
}

// Conditionally bind based on environment
$this->app->bind(StorageDriver::class, function ($app) {
    return match(config('app.env')) {
        'local' => new LocalStorageDriver(),
        'production' => new S3StorageDriver(),
    };
});
            </div>

            <div class="quiz-box">
                <h4>🧪 Проверь себя</h4>
                <div class="quiz-question">
                    <strong>Q: Why use interfaces in DI instead of concrete classes?</strong>
                    <div class="quiz-answer">
                        <strong>A:</strong> Interfaces allow you to swap implementations. If you depend on PaymentProcessor interface, you can swap Stripe for PayPal without changing code. This satisfies Dependency Inversion Principle.
                    </div>
                </div>
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Create: UserRepository interface + 2 implementations (Eloquent, Mock). Bind in ServiceProvider. Inject into UserService. Write tests that use mock implementation. Verify that tests run without database.</p>
            </div>
        </section>

        <!-- MVC and Variations -->
        <section id="mvc">
            <h2>MVC and Its Variations</h2>
            <p>Model-View-Controller is an architectural pattern separating an application into three components. Understanding its variations helps you choose the right architecture for your application.</p>

            <h3>Classic MVC</h3>
            <div class="diagram">
┌────────────────────────────┐
│         User                │
└────────────┬─────────────────┘
             │
             ▼
┌────────────────────────────┐
│  View (HTML/JSON)          │
│  ↓ User interaction        │
└────────────┬─────────────────┘
             │
             ▼
┌────────────────────────────┐
│  Controller                │
│  • Parse input             │
│  • Call service/model      │
│  • Return response         │
└────────────┬─────────────────┘
             │
             ▼
┌────────────────────────────┐
│  Model                     │
│  • Business logic          │
│  • Database queries        │
│  • Data validation         │
└────────────────────────────┘
            </div>

            <h3>MVC Issues (Fat Controllers/Models)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Problem</th>
                        <th>Symptom</th>
                        <th>Solution</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fat Controller</td>
                        <td>Controllers with 500+ lines</td>
                        <td>Extract to Service Layer</td>
                    </tr>
                    <tr>
                        <td>Fat Model</td>
                        <td>Models with many methods</td>
                        <td>Use Service + Repository</td>
                    </tr>
                    <tr>
                        <td>No abstraction</td>
                        <td>Hard to change implementation</td>
                        <td>Use interfaces + DI</td>
                    </tr>
                    <tr>
                        <td>Difficult to test</td>
                        <td>Tests require full stack</td>
                        <td>Inject dependencies</td>
                    </tr>
                </tbody>
            </table>

            <h3>Modern Laravel with Service Layer</h3>
            <div class="diagram">
┌──────────────────────────────┐
│      HTTP Request            │
└──────────────┬────────────────┘
               │
               ▼
┌──────────────────────────────┐
│      Controller              │
│  (HTTP handling only)        │
└──────────────┬────────────────┘
               │
               ▼
┌──────────────────────────────┐
│      Service Layer           │
│  (Business logic)            │
└──────────────┬────────────────┘
               │
               ▼
┌──────────────────────────────┐
│      Repository Layer        │
│  (Data access)               │
└──────────────┬────────────────┘
               │
               ▼
┌──────────────────────────────┐
│      Eloquent Model          │
│  (Database + attributes)     │
└──────────────────────────────┘
            </div>

            <h3>MVP (Model-View-Presenter)</h3>
            <p>In MVP, the Presenter handles all logic. View is completely passive and doesn't know the Model.</p>
            <div class="code-block code-good">
// View is passive (just display)
class UserListView {
    public function display(array $users): void {
        foreach ($users as $user) {
            echo $user['name'];
        }
    }
}

// Presenter orchestrates everything
class UserPresenter {
    public function __construct(
        private UserRepository $repository,
        private UserListView $view
    ) {}

    public function show(): void {
        $users = $this->repository->all();
        $this->view->display($users);
    }
}

// Model is unchanged
class User extends Model { }
            </div>

            <h3>MVVM (Model-View-ViewModel)</h3>
            <p>ViewModel transforms Model data for the View. Popular in frontend frameworks like Vue.js, Angular.</p>
            <div class="code-block code-good">
// ViewModel prepares data for view
class UserViewModel {
    public function __construct(private User $user) {}

    public function formattedName(): string {
        return strtoupper($this->user->name);
    }

    public function joinedDate(): string {
        return $this->user->created_at->format('M d, Y');
    }

    public function isAdmin(): bool {
        return $this->user->hasRole('admin');
    }
}

// View uses ViewModel
class UserController {
    public function show(User $user) {
        $viewModel = new UserViewModel($user);
        return view('user.show', ['user' => $viewModel]);
    }
}

// In view: {{ $user->formattedName() }}
            </div>

            <h3>Laravel Implementation Recommendation</h3>
            <div class="code-block code-good">
// RECOMMENDED: Service + Repository + Model

// 1. Controller: Only HTTP
class OrderController extends Controller {
    public function __construct(private OrderService $service) {}

    public function store(Request $request) {
        $order = $this->service->createOrder($request->validated());
        return response()->json($order);
    }
}

// 2. Service: Business logic
class OrderService {
    public function __construct(
        private OrderRepository $orders,
        private PaymentProcessor $payment
    ) {}

    public function createOrder(array $data): Order {
        // Validate, process payment, create order
    }
}

// 3. Repository: Data access
class OrderRepository {
    public function create(array $data): Order {
        return Order::create($data);
    }
}

// 4. Model: Relationships + validation
class Order extends Model {
    protected $fillable = ['product_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Refactor a Laravel app with fat controllers/models into: thin controller → service → repository → model structure. Measure how testability improves. Identify where each type of logic belongs.</p>
            </div>
        </section>

        <!-- DDD Basics -->
        <section id="ddd">
            <h2>Domain-Driven Design (DDD) Basics</h2>
            <p>Domain-Driven Design focuses on the business domain, using a shared language between developers and business stakeholders. It's powerful for complex domains but overkill for simple CRUD apps.</p>

            <h3>Key Concepts</h3>
            <table>
                <thead>
                    <tr>
                        <th>Concept</th>
                        <th>Definition</th>
                        <th>Laravel Example</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Entity</strong></td>
                        <td>Object with unique identity (ID)</td>
                        <td>User, Order, Product (Eloquent Models)</td>
                    </tr>
                    <tr>
                        <td><strong>Value Object</strong></td>
                        <td>Object defined by values, no ID</td>
                        <td>Money, Email, Address (immutable objects)</td>
                    </tr>
                    <tr>
                        <td><strong>Aggregate</strong></td>
                        <td>Cluster of entities/VOs around root</td>
                        <td>Order (with Items, ShippingAddress)</td>
                    </tr>
                    <tr>
                        <td><strong>Repository</strong></td>
                        <td>Persistence abstraction</td>
                        <td>UserRepository interface</td>
                    </tr>
                    <tr>
                        <td><strong>Domain Service</strong></td>
                        <td>Business logic spanning aggregates</td>
                        <td>OrderCreationService</td>
                    </tr>
                    <tr>
                        <td><strong>Bounded Context</strong></td>
                        <td>Explicit boundary in domain</td>
                        <td>Order context, Payment context, Inventory context</td>
                    </tr>
                </tbody>
            </table>

            <h3>Value Object Example</h3>
            <div class="code-block code-good">
// Immutable value object for email
final class Email {
    private function __construct(private string $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }

    public static function from(string $email): self {
        return new self($email);
    }

    public function value(): string {
        return $this->value;
    }

    public function equals(Email $other): bool {
        return $this->value === $other->value;
    }
}

// Usage
$email = Email::from('user@example.com');  // Valid
// $invalid = Email::from('not-an-email');  // Exception!

// Type-safe
class User extends Model {
    public function setEmailAttribute(string $value): void {
        $this->attributes['email'] = Email::from($value)->value();
    }
}
            </div>

            <h3>Aggregate Example</h3>
            <div class="code-block code-good">
// Order is the aggregate root
class Order extends Model {
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function addItem(Product $product, int $quantity): void {
        if ($quantity <= 0) {
            throw new InvalidQuantityException();
        }

        $this->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
        ]);
    }

    public function totalPrice(): Money {
        return $this->items()->sum('price');
    }
}

// OrderItem is part of Order aggregate
// You don't load OrderItem directly - always through Order
class OrderItem extends Model {
    public function order() {
        return $this->belongsTo(Order::class);
    }
}

// Usage
$order = Order::find(1);
$order->addItem($product, 2);  // Add through root
            </div>

            <h3>Simplified DDD for Laravel</h3>
            <div class="code-block code-good">
// Create Domain folder structure
app/Domain/
  ├── Order/
  │   ├── Models/Order.php
  │   ├── Models/OrderItem.php
  │   ├── Repositories/OrderRepository.php
  │   ├── Services/CreateOrderService.php
  │   └── Events/OrderCreated.php
  ├── Payment/
  │   ├── Models/Payment.php
  │   ├── Services/PaymentService.php
  │   └── Events/PaymentProcessed.php
  └── Inventory/
      ├── Models/Stock.php
      ├── Repositories/InventoryRepository.php
      └── Services/ReserveStockService.php

// Use bounded contexts to separate concerns
// Order context doesn't directly call Payment queries
// Instead, it fires OrderCreated event that Payment listens to
            </div>

            <h3>When DDD is Overkill</h3>
            <p>Don't use DDD for:</p>
            <ul style="margin-left: 20px;">
                <li>Simple CRUD applications</li>
                <li>Prototype or MVP projects</li>
                <li>Applications with simple business logic</li>
                <li>Small teams or solo projects</li>
            </ul>

            <p style="margin-top: 15px;"><strong>Use DDD when:</strong></p>
            <ul style="margin-left: 20px;">
                <li>Complex business domain</li>
                <li>Business rules change frequently</li>
                <li>Multiple teams working on same system</li>
                <li>Need clear boundaries between features</li>
            </ul>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Design an e-commerce domain using DDD: identify aggregates (Order, Customer), value objects (Money, Email), bounded contexts (Order, Payment, Inventory). Create folder structure and basic models.</p>
            </div>
        </section>

        <!-- Clean Architecture -->
        <section id="clean-architecture">
            <h2>Clean Architecture</h2>
            <p>Clean Architecture, described by Robert Martin, organizes code into concentric layers with clear dependency direction. Inner layers (domain) don't depend on outer layers (framework).</p>

            <h3>The Dependency Rule</h3>
            <p><strong>Source code dependencies must point inward.</strong> High-level policy (domain) must not depend on low-level details (framework, database).</p>

            <div class="diagram">
┌────────────────────────────────────────┐
│        ENTERPRISE RULES (Domain)       │
│     ┌─────────────────────────────┐   │
│     │   APPLICATION RULES         │   │
│     │  ┌───────────────────────┐  │   │
│     │  │ INTERFACE ADAPTERS    │  │   │
│     │  │ ┌───────────────────┐ │  │   │
│     │  │ │  FRAMEWORKS/LIBS  │ │  │   │
│     │  │ └───────────────────┘ │  │   │
│     │  └───────────────────────┘  │   │
│     └─────────────────────────────┘   │
└────────────────────────────────────────┘

Dependency Direction: INWARD ↑
            </div>

            <h3>Layers Explained</h3>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">1. Entities (Domain Layer)</h4>
            <p>Business rules that don't change. Should be completely independent of framework.</p>
            <div class="code-block code-good">
// app/Domain/Order/Order.php
namespace App\Domain\Order;

class Order {
    private int $id;
    private int $customerId;
    private array $items;
    private Money $totalPrice;

    public function __construct(int $customerId) {
        $this->customerId = $customerId;
        $this->items = [];
    }

    public function addItem(OrderItem $item): void {
        if ($item->quantity <= 0) {
            throw new InvalidQuantityException();
        }
        $this->items[] = $item;
    }

    public function getTotalPrice(): Money {
        return array_reduce(
            $this->items,
            fn($total, $item) => $total->add($item->getPrice()),
            Money::zero()
        );
    }
}

// No Laravel dependency! Domain logic is pure.
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">2. Application Layer (Use Cases)</h4>
            <p>Application-specific business rules. Orchestrates entities and adapters.</p>
            <div class="code-block code-good">
// app/Application/Order/CreateOrder/CreateOrderUseCase.php
namespace App\Application\Order\CreateOrder;

class CreateOrderUseCase {
    public function __construct(
        private OrderRepository $orderRepository,
        private PaymentGateway $paymentGateway,
        private NotificationGateway $notificationGateway,
    ) {}

    public function execute(CreateOrderRequest $request): CreateOrderResponse {
        try {
            // Create domain entity
            $order = new Order($request->customerId);

            foreach ($request->items as $item) {
                $order->addItem(new OrderItem(...));
            }

            // Persist via repository
            $this->orderRepository->save($order);

            // Call external services
            $payment = $this->paymentGateway->charge($order->getTotalPrice());
            $this->notificationGateway->sendConfirmation($order);

            return new CreateOrderResponse(true, $order->getId());
        } catch (DomainException $e) {
            return new CreateOrderResponse(false, null, $e->getMessage());
        }
    }
}
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">3. Interface Adapters (Controllers, Presenters)</h4>
            <p>Converts between use cases and external details (HTTP, Database).</p>
            <div class="code-block code-good">
// app/Http/Controllers/OrderController.php (Adapter)
class OrderController extends Controller {
    public function __construct(
        private CreateOrderUseCase $useCase
    ) {}

    public function store(Request $request) {
        // Adapt HTTP Request to Use Case Request
        $useCaseRequest = new CreateOrderRequest(
            customerId: $request->user()->id,
            items: $request->input('items'),
        );

        // Execute use case
        $response = $this->useCase->execute($useCaseRequest);

        // Adapt Use Case Response to HTTP Response
        if ($response->successful) {
            return response()->json(['id' => $response->orderId], 201);
        } else {
            return response()->json(['error' => $response->error], 400);
        }
    }
}

// app/Infrastructure/Persistence/EloquentOrderRepository.php
class EloquentOrderRepository implements OrderRepository {
    public function save(Order $order): void {
        // Adapt domain Order to Eloquent Model
        OrderModel::create([
            'customer_id' => $order->getCustomerId(),
            'total_price' => $order->getTotalPrice()->getAmount(),
        ]);
    }

    public function findById(int $id): Order {
        $model = OrderModel::findOrFail($id);
        // Adapt Eloquent Model to domain Order
        return new Order($model->customer_id);
    }
}
            </div>

            <h4 style="color: var(--accent-blue); margin-top: 20px;">4. Frameworks & Drivers (Laravel, Database)</h4>
            <p>Outermost layer. Should be easy to replace.</p>
            <div class="code-block code-good">
// Laravel is just a tool here
// If you swap Symfony, the domain and application layers unchanged
            </div>

            <h3>Hexagonal Architecture (Ports & Adapters)</h3>
            <p>Similar to Clean Architecture but visualized as ports (interfaces) on the application boundary and adapters (implementations) outside.</p>
            <div class="diagram">
┌────────────────────────────────────┐
│    Domain Logic (Framework-free)   │
│     ┌──────────────────────────┐   │
│     │  Use Cases (Pure Logic)  │   │
│     └──────────────────────────┘   │
└────────────────────────────────────┘
        ↑           ↑           ↑
    PORT 1      PORT 2      PORT 3
        ↓           ↓           ↓
┌──────────────────────────────────────┐
│  ADAPTERS (Specific implementations) │
│  ┌──────────┐  ┌──────────┐  ┌────┐ │
│  │ HTTP API │  │ CLI      │  │ DB │ │
│  └──────────┘  └──────────┘  └────┘ │
└──────────────────────────────────────┘
            </div>

            <h3>When to Use Clean Architecture</h3>
            <table>
                <thead>
                    <tr>
                        <th>Use Clean Architecture</th>
                        <th>Simpler Approach OK</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Large, complex domain</td>
                        <td>Simple CRUD app</td>
                    </tr>
                    <tr>
                        <td>Multiple teams</td>
                        <td>Solo developer</td>
                    </tr>
                    <tr>
                        <td>Want framework independence</td>
                        <td>Locked into Laravel forever</td>
                    </tr>
                    <tr>
                        <td>Frequent requirement changes</td>
                        <td>Stable, fixed requirements</td>
                    </tr>
                    <tr>
                        <td>Complex business rules</td>
                        <td>Logic mostly in database</td>
                    </tr>
                </tbody>
            </table>

            <h3>Simplified Clean Architecture for Laravel</h3>
            <p>Don't over-engineer. Use clean principles pragmatically:</p>
            <div class="code-block code-good">
// Folder structure
app/
├── Domain/              # Pure business logic (NO Laravel!)
│   └── Order/
│       ├── Order.php
│       └── OrderRepository.php  (interface)
│
├── Services/            # Application logic (services)
│   └── CreateOrderService.php
│
├── Http/                # Interface adapters (Eloquent models, controllers)
│   └── Controllers/
│       └── OrderController.php
│
└── Repositories/        # Adapter implementation
    └── EloquentOrderRepository.php

// Key principle: Domain ≠ Eloquent Model
// Domain logic is framework-independent
// Eloquent models adapt domain to Laravel/database
            </div>

            <div class="exercise-box">
                <h4>Задание</h4>
                <p>Refactor a Laravel application using Clean Architecture principles: create pure domain entities, separate application use cases from infrastructure adapters, ensure no framework code in domain layer. Verify that core business logic can be tested without Laravel.</p>
            </div>

            <div class="reference-box">
                <h4>📖 References</h4>
                <p><strong>Books:</strong> Clean Architecture (Robert Martin), Implementing Domain-Driven Design (Vaughn Vernon)</p>
                <p><strong>Web:</strong> Martin Fowler's architecture guides, Alistair Cockburn's Hexagonal Architecture</p>
            </div>
        </section>

        <!-- Summary & Next Steps -->
        <section style="background-color: #1a1f26; border-left: 4px solid var(--accent-green);">
            <h2 style="color: var(--accent-green);">🎓 Summary & Next Steps</h2>

            <h3>What You've Learned</h3>
            <p>You now understand the foundational patterns and principles that separate junior from senior developers:</p>
            <ul style="margin-left: 20px; color: var(--text-primary);">
                <li><strong>SOLID Principles:</strong> Write maintainable, testable code that respects separation of concerns</li>
                <li><strong>Design Patterns:</strong> Repository, Service, Factory, Observer, Strategy—tools for common problems</li>
                <li><strong>Architectural Styles:</strong> MVC, Clean Architecture, DDD—choose based on complexity</li>
                <li><strong>Dependency Injection:</strong> The foundation for loose coupling and testability</li>
            </ul>

            <h3>Progression Path</h3>
            <div style="background-color: var(--bg-tertiary); padding: 20px; border-radius: 4px; margin: 20px 0;">
                <p><strong>🟢 Beginner:</strong> Learn one pattern (Repository). Use it everywhere.</p>
                <p><strong>🟡 Intermediate:</strong> Mix patterns. Know when to use each. Follow SOLID.</p>
                <p><strong>🔴 Advanced:</strong> Design architectures. Balance complexity with simplicity. Know when NOT to use patterns.</p>
            </div>

            <h3>Common Mistakes to Avoid</h3>
            <ul style="margin-left: 20px; color: var(--text-primary);">
                <li>Over-engineering: Using patterns on simple CRUD apps</li>
                <li>Under-designing: Ignoring SOLID on complex domains</li>
                <li>Copy-paste architecture: Using patterns without understanding why</li>
                <li>Ignoring testing: Tight coupling that makes tests impossible</li>
                <li>Framework lock-in: Making business logic depend on Laravel</li>
            </ul>

            <h3>Practice Exercises</h3>
            <ol style="margin-left: 20px; color: var(--text-primary);">
                <li>Take an existing Laravel project. Identify SOLID violations. Refactor.</li>
                <li>Build a feature using Service + Repository patterns. Test without database.</li>
                <li>Create domain entities that are completely framework-independent.</li>
                <li>Design a system with bounded contexts (Order, Payment, Inventory).</li>
                <li>Implement Strategy pattern for pluggable implementations.</li>
            </ol>

            <h3>Further Reading</h3>
            <div style="background-color: var(--bg-primary); padding: 15px; border-radius: 4px; margin: 15px 0;">
                <p><strong>Books:</strong></p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Clean Code (Robert C. Martin)</li>
                    <li>Design Patterns: Elements of Reusable Object-Oriented Software (Gang of Four)</li>
                    <li>Clean Architecture (Robert C. Martin)</li>
                    <li>Implementing Domain-Driven Design (Vaughn Vernon)</li>
                </ul>

                <p style="margin-top: 15px;"><strong>Websites:</strong></p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>martinfowler.com - Architecture & Patterns</li>
                    <li>refactoring.guru - Design Patterns with Examples</li>
                    <li>Laravel.com - Official Laravel Architecture Guides</li>
                    <li>DDD Community - dddcommunity.org</li>
                </ul>
            </div>
        </section>

        <footer class="footer">
            <p>Architecture & Design Patterns Knowledge Base</p>
            <p>For PHP/Laravel Backend Developers</p>
            <p style="margin-top: 15px; font-size: 0.9em;">Last Updated: 2026-04-08 | Remember: Choose simplicity first, add architecture as complexity demands.</p>
        </footer>
    </div>

    <script>

        // Collapsible functionality
        document.querySelectorAll('.collapsible').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (content && content.classList.contains('collapsible-content')) {
                    content.classList.toggle('show');
                }
            });
        });

        // Quiz functionality
        document.querySelectorAll('.quiz-question').forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.querySelector('.quiz-answer');
                if (answer) {
                    answer.classList.toggle('show');
                }
            });
        });

        // Smooth scroll for TOC links
        document.querySelectorAll('.toc a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
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