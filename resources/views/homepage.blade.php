@extends('layouts.master', ['homepageLink' => 'active'])

@section('title'){{ env('APP_NAME') }} @stop

@section('meta')
    <meta name="title" content="" />
    <meta name="description" content="" />

    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="{{ url('/') }}" />
@stop

@push('style')
    <link rel="stylesheet" href="{{ mix('/css/app-stack.css') }}" />
@endpush

@section('content')
<div class="container">
    <div class="content">
        <h1>Wykryte problemy</h1>
        <ol>
            <li>
                Dużo niepotrzebnych "defaultowych" rzeczy zostało po instalacji l9 które nie zostały usunięte (sprząntnięte)
            </li>
            <li>
                routes/web.php routes:
                <ul>
                    <li>Zamiast osobnych routów można użyć resource (w przypadku CRUDa nawet trzeba). Jeżeli jest konieczne wpisywanie pojedynczych routów to warto użyć "route group".</li>
                    <li>
                        Pozatym, są podane nieprawidłowe ścieżki i nazwy akcji. Np. Route::post('user/create', [UserController::class, 'save']);. "save" powinno być nazwane "store". Route "POST store" musi być robione na link "/users" a nie "user/create" (zgodnie z zasadą).
                        Czyli tak jak jest opisane w dokumentacji: <a href="https://laravel.com/docs/9.x/controllers" class="fw-bold" target="_blank">https://laravel.com/docs/9.x/controllers</a>
                    </li>
                    <li>Brak routingu "users.index" (listy użytkowników)</li>
                    <li>Brak nazw routingów (route name) oraz brak wykorzystania nazw routów w kodzie zamiast sztywnych linków</li>
                    <li>"Route::get('user/{id}/delete', [UserController::class, 'delete']);". Delete jako GET chyba nie jest najlepsze podejście =) Ma być DELETE method</li>
                    <li>"Route::post('user/{id}/update', [UserController::class, 'update']);" - dla update raczej PUT</li>
                </ul>
            </li>
            <li>
                UserController:
                <ul>
                    <li>Controller nie został wygenerowany przy użyciu comendy Artisana "php artisan make:controller", tylko skopiowany z innego projektu albo pisany "ręcznie"</li>
                    <li>Raczej powinno się unikać "request()->all()", szczególnie przy entity UPDATE. Zamiast tego należ użyć "$request->validated()"</li>
                </ul>
            </li>
            <li>
                UserRequest.php:
                <ul>
                    <li>łamie zasadę Solid (single responsibility)</li>
                    <li>w przypadku walidacji pola email - brakuje "unique:users"</li>
                </ul>
            </li>
            <li>
                Brak Laravel auth routes z logowaniem użytkownika oraz middleware. Zakładam, że to tak miało być, ale Sanctum albo Breeze uprościłyby sprawę.
            </li>
            <li>
                Database user password. <b>Hasło w bazie danych jest trzymane w jawnej postaci</b>
            </li>
            <li>
                resources\views\welcome.blade.php:
                <ul>
                    <li>lista użytkowników powinna być w pliku w nazwie "index.blade.php"</li>
                    <li>Użytkownicy (encje) są wyciągane z bazy danych bezpośrednio w pliku blade, na dodatek poprzez \DB</li>
                    <li>To coś "#php $id = $user->id #endphp" raczej nie jest zbyt potrzebne</li>
                    <li>
                        linki to tagu <a> są wpisywane na sztywno "{{ '<a href="/user/$id">Edit</a>' }}".
                        Nie jest to dobre podejście. Należy wpisywać route name, gdyż w przypadku zmiany linku trzeba będzie zmieniać w wielu miejscach.
                        Wiem że jest to tylko prosty CRUD, ale należy trzymać się zasad żeby wwszędzie było tak samo
                    </li>
                    <li>Wyciągane są wszystkie rekordy z tabeli "users", co jest "problematyczne" w przypadku dużej ilości użytkowników</li>
                    <li>Brak paginacji użytkowników</li>
                </ul>
            </li>
            <li>
                resources\views\user. Folder powinien się nazywać "users" (zgodnie z zasadą)
            </li>
            <li>
                Views: brak jednego wspólnego layout. HTML jest dublowany w każdym pliku *.blade.php
            </li>
            <li>
                Literówka w nazwie pliku "crreate.blade.php" => "create.blade.php"
            </li>
            <li>
                UserController.php:
                <ul>
                    <li>"final class UserController" => "class UserController"</li>
                    <li>app()->make(UserService::class)->save($request);</li>
                </ul>
            </li>
            <li>
                UserService.php
                <ul>
                    <li>Namieszane</li>
                    <li>UserService.php używa UserRepository. Albo service, albo Repository</li>
                    <li>final class UserService. Gdyby w przyszłości była potrzeba utworzyć nowy service dla "Innych/Premium" users to nie będzie możliwości extends UserService</li>
                    <li>metoda "GetById" nie jest nazwana zgodnie z PSR-1 (camelCase method name) => "getById". <a href="https://www.php-fig.org/psr/psr-1/" class="fw-bold" target="_blank">https://www.php-fig.org/psr/psr-1/</a>. Pozatym nie jest w ogóle potrzebna gdyż Eloquent dostarcza metody find($id), findOrFail($id);</li>
                </ul>
            </li>
            <li>
                UserRepository:
                <ul>
                    <li>
                        <b>Podeście "Repository Pattern" NIE powinno być używane w Laravelu</b>, gdyż jest Eloquent, który nam dostarcza wszystko co jest potrzebne a nawet więcej.
                        Używanie Repositories jest <b>wymyślaniem koła na nowo</b>. Podeście Repositories istnieje, ale powinno być używane w baaaaaaardzo specyficznych przypadkach, na pewno nie w Users CRUD.
                        Dlaczego nie używać Repositories w Laravelu tłumaczy programista 15+ na tym kanale <b>Laravel Daily</b> <a href="https://youtu.be/giJcdfW2wC8" class="fw-bold" target="_blank">https://youtu.be/giJcdfW2wC8</a>
                    </li>
                    <li>UserService, UserRepository, AbstractRepository. Chyba za dużo wszystkiego na jednego User :)</li>
                </ul>
            </li>
            <li>
                AbstractRepository:
                <ul>
                    <li>Metoda "getById" zwraca kolekcję. ID jest autoincrement i jest unikalne. Pozatym Eloquent już ma find() i findOrFail()</li>
                    <li>Metoda "getAll" - bez sensu. "all()" Eloquent'a robi to samo</li>
                    <li>Metoda "getByEmail" zwraca kolekcję. email jest unique index</li>
                </ul>
            </li>
            <li>
                Dodałem dodatkowe rzeczy w plikach konfiguracyjnych. Są przydatne, szczególnie na produkcji:
                <ul>
                    <li>config/database.php brak ustawionego silnika bazy danych. Raczej InnoDB jest wykorzystywany</li>
                    <li>config/app.php</li>
                    <li>config/session.php</li>
                    <li>App/Providers/AppServiceProvider.php</li>
                    <li>te rzeczy zostały również dodane do .env oraz .env.example</li>
                </ul>
            </li>
            <li>
                Chyba "final class" oraz "declare(strict_types=1);" są upychane na siłe nawet tam gdzie to nie jest używane/konieczne
            </li>
            <li>
                Dodałem bootstrap oraz pozmieniałem trochę blade'y żeby to jakoś w miarę wyglądało. Assets były robione na szybko
            </li>
        </ol>

        <h2>Po naniesieniu zmian: git status</h2>
        <pre>
Changes not staged for commit:
(use "git add/rm <file>..." to update what will be committed)
(use "git restore <file>..." to discard changes in working directory)
      modified:   .env.example
      modified:   .gitignore
      modified:   README.md
      modified:   app/Http/Controllers/UserController.php
      deleted:    app/Http/Requests/UserRequest.php
      modified:   app/Providers/RouteServiceProvider.php
      deleted:    app/Repositories/AbstractRepository.php
      deleted:    app/Repositories/UserRepository.php
      modified:   app/Services/UserService.php
      modified:   config/app.php
      modified:   config/database.php
      modified:   config/session.php
      modified:   database/seeders/DatabaseSeeder.php
      modified:   package.json
      modified:   phpunit.xml
      deleted:    resources/css/app.css
      modified:   resources/js/app.js
      modified:   resources/js/bootstrap.js
      deleted:    resources/views/user/crreate.blade.php
      deleted:    resources/views/user/edit.blade.php
      deleted:    resources/views/welcome.blade.php
      modified:   routes/api.php
      modified:   routes/channels.php
      modified:   routes/console.php
      modified:   routes/web.php
      deleted:    tests/Feature/ExampleTest.php
      deleted:    tests/Unit/ExampleTest.php
      modified:   webpack.mix.js

Untracked files:
(use "git add <file>..." to include in what will be committed)
      app/Http/Requests/CreateUserRequest.php
      app/Http/Requests/UpdateUserRequest.php
      package-lock.json
      public/mix-manifest.json
      resources/sass/
      resources/views/homepage.blade.php
      resources/views/layouts/
      resources/views/users/
      tests/Feature/DatabaseTest.php
      tests/Feature/RoutesTest.php
      tests/Unit/UserTest.php
        </pre>

        <h2>Instalacja</h2>
        <ol>
            <li>composer install</li>
            <li>Utwórz plik .env i skonfiguruj połączenie z bazą danych</li>
            <li>php artisan key:generate</li>
            <li>php artisan migrate --seed</li>
            <li>npm install</li>
            <li>npm run dev</li>
        </ol>
        <h2>Uruchamianie serwera</h2>
        <p>
            - php artisan serve
        </p>
    </div>
</div>
@stop

@push('scripts')
    <script src="{{ mix('/js/app-stack.js') }}"></script>
@endpush
