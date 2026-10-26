<?php

/**
 * Interface strings and module titles in English.
 * The Russian counterpart is lang/ru/kb.php; the keys must stay in sync.
 */
return [

    'hub_title'       => 'Backend Knowledge Base',
    'hub_lead'        => 'Programming, infrastructure and everything that comes with them.',
    'features_title'  => 'How this base is organised',
    'modules_title'   => 'Knowledge Base — Modules',
    'extra_title'     => 'Supplementary',
    'advanced_title'  => 'Advanced (middle/senior)',
    'methodology_title' => 'Method',

    'search_placeholder' => 'Search this module',
    'search_empty'       => 'Nothing found',
    'search_pending'     => 'Searching the body text…',
    'search_in_text'     => 'In section text',
    'search_module'      => 'Knowledge base module',

    'back_home'   => 'Back to hub',
    'toc_title'   => 'On this page',
    'menu'        => 'Menu',
    'theme_light' => 'Light theme',
    'theme_dark'  => 'Dark theme',
    'accent_red'  => 'Red accent',
    'accent_blue' => 'Blue accent',
    'lang_switch' => 'Переключить на русский',

    'untranslated' => 'This module has not been translated yet — showing the Russian text.',

    'groups' => [
        'Modules'       => 'Modules',
        'Дополнительно' => 'Supplementary',
        'Advanced'      => 'Advanced',
        'Methodology'   => 'Method',
    ],

    /**
     * Module titles and descriptions.
     * Names of technologies keep their official spelling: Laravel, Eloquent,
     * Node.js, NestJS, Nginx, Docker, Composer.
     */
    'modules' => [

        'Backend_Learning_Program' => [
            'title' => 'Programme &amp; Schedule',
            'description' => 'A nine-phase roadmap, a sixteen-week schedule built on spaced repetition, and 24 questions to check yourself against.',
        ],

        'KB_1_PHP_Core' => [
            'title' => 'PHP Core',
            'description' => 'Types, OOP, traits, interfaces, magic methods, namespaces, PHP 8.x, generators, closures. 12 sections.',
        ],

        'KB_2_SQL_Database' => [
            'title' => 'SQL &amp; Databases',
            'description' => 'The relational model, normalisation, JOIN semantics, indexes (B-tree, GIN, covering, leftmost prefix), transactions and isolation levels, query plans.',
        ],

        'KB_3_Laravel' => [
            'title' => 'Laravel',
            'description' => 'Request lifecycle, routing with scoped bindings, middleware and terminate, validation and form requests, Eloquent, cache, queues, events, scheduler, authentication, Octane.',
        ],

        'KB_4_Security' => [
            'title' => 'Security',
            'description' => 'OWASP Top 10, password hashing (bcrypt, Argon2), JWT and Sanctum, OAuth 2.0 with PKCE, RBAC and ABAC, CSRF, XSS, SQL injection.',
        ],

        'KB_5_Architecture' => [
            'title' => 'Architecture &amp; Patterns',
            'description' => 'SOLID principles, Gang of Four patterns (factory, strategy, observer, decorator, adapter), repository and service layers, DTOs, refactoring from bad to good.',
        ],

        'KB_6_Testing_DevOps' => [
            'title' => 'Testing &amp; DevOps',
            'description' => 'PHPUnit and Pest fundamentals, unit and feature tests, TDD, Docker and Docker Compose, Git workflow, CI/CD.',
        ],

        'KB_9_Laravel_Inheritance' => [
            'title' => 'Inheritance &amp; Base Classes',
            'description' => 'What Controller, Model, FormRequest, Middleware, Job, Command, Notification and Mailable actually inherit, and what each base class gives you.',
        ],

        'KB_10_Laravel_Helpers' => [
            'title' => 'Helpers &amp; Methods',
            'description' => 'A practical reference: request and validation, Eloquent, collections, Str, Arr, Carbon, session, cache, files, and the PHP behind the helpers.',
        ],

        'KB_11_Cloud_DevOps_Networking' => [
            'title' => 'Cloud &amp; DevOps — Networking',
            'description' => 'Virtualisation (VMs, hypervisors), network types, the OSI and TCP/IP models with worked examples, MAC, IPv4 and IPv6, ARP, DNS, HTTP and TLS.',
        ],

        'KB_12_Eloquent_Advanced' => [
            'title' => 'Eloquent Advanced',
            'description' => 'A deep pass over every relation type (polymorphic and has-many-through included), custom casts, observers, scopes, soft deletes and query performance.',
        ],

        'KB_13_Service_Container_DI' => [
            'title' => 'Service Container &amp; DI',
            'description' => 'The architectural core of Laravel: bindings, contextual and tagged bindings, autowiring, service providers, deferred providers, package providers.',
        ],

        'KB_14_Testing_Deep' => [
            'title' => 'Testing in Depth',
            'description' => 'Test doubles as Meszaros defines them, test design, the pyramid, trophy and honeycomb, database strategies, parallel runs, snapshot tests.',
        ],

        'KB_16_JavaScript_jQuery' => [
            'title' => 'JavaScript + jQuery — Fundamentals',
            'description' => 'Core JavaScript (types, var/let/const, == versus ===, functions and arrow-function this, map/filter/reduce, the DOM) alongside jQuery and its interplay with PHP.',
        ],

        'KB_17_Vue' => [
            'title' => 'Vue.js — Fundamentals',
            'description' => 'Vue 3: Options and Composition API, reactivity (ref, reactive, computed, watch), directives, components, and the full path from a form to an API.',
        ],

        'KB_18_Nginx_Docker' => [
            'title' => 'Nginx &amp; Docker — Deployment',
            'description' => 'A hands-on module: Nginx (fundamentals, files, systemctl, configuration, server blocks, location, PHP-FPM) and Docker for everyday work.',
        ],

        'KB_19_Python' => [
            'title' => 'Python — Core and Web',
            'description' => 'Python 3.11+ for a backend developer coming from PHP and Laravel: installation, syntax, types, OOP, modules, async, FastAPI, Flask, Django, databases.',
        ],

        'KB_20_CLI_Bash_Git_Composer' => [
            'title' => 'CLI: Bash · Git · Composer',
            'description' => 'Three everyday tools. Bash: navigation, grep and find, processes, rwx permissions, pipes. Git: branches, merges, conflicts. Composer: dependencies and autoloading.',
        ],

        'KB_21_NodeJS_NestJS' => [
            'title' => 'Node.js and NestJS',
            'description' => 'How the runtime works and how the framework is built: the event loop and its phases, the thread pool, errors in async code, dependency injection, the request lifecycle.',
        ],

        'KB_22_React_TypeScript_Tailwind' => [
            'title' => 'React · TypeScript · Tailwind',
            'description' => 'The frontend minimum: hooks and dependency arrays, what causes re-renders and when to memoise, where state belongs, types versus validation, utility-first styling.',
        ],

        'Schedule_Daily' => [
            'title' => 'Daily Schedule',
            'description' => 'A detailed plan for a single day of study, built around spaced repetition.',
        ],
    ],
];
