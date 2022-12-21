
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Al clonar proyecto:

**Crear .env**
1. [Ver en la sección 'Dev notes' **hasta abajo**]

**Actualizar e instalar dependencias**
1. composer update
2. composer install
3. npm install

**Levantar servidor de Laravel**
4. php artisan serve

**Bundling y compilacion de codigo Javascript y CSS**
5. npm run dev

---

# Dev Notes

### Remember that...

**servicio-social-project/app/Http/Middleware/VerifyCsrfToken.php**
Whenever we create a route in web.php, we have to send the CSRF token within payload, however, we do not want it so we avoid it 
declaring the routes in the $except array

```
protected $except = [
        'api/auth/login',
        'api/auth/register',
        'api/auth/logout',
    ];
```


**servicio-social-project/app/Http/Middleware/Authenticate.php**
We declare a route to redirect by default, in this case, the login view

```
return route('login_view');
```


**servicio-social-project/app/Http/Controllers/AuthController.php**
Here we can find the LOGIN, REGISTER and LOGOUT endpoints' methods


**servicio-social-project/app/Http/Kernel.php**
Here we encounter the Middlewares which routes have and other Middlewares which routes can have

The array protected $middleware... specify middlewares every route has
The array protected $middlewareGroups... specify middlewares as pear which type the route is, whether 'web' or 'api'
The array protected $routeMiddleware... specify serie of middlewares which can obtain routes if they are part of certain group


**servicio-social-project/app/Models/User.php**
There is a method:

```
public function setPasswordAttribute($password)
{
   \$this->attributes['password'] = bcrypt($password);
}
```

this is needed when using Auth here in Laravel


**servicio-social-project/app/Providers/ResponseMacroServiceProvider.php**
There are two blocks of code that allows us to create standardize 'success' and 'error' Responses, those ones just return JSON

```
public function boot()
  {
    Response::macro('success', function ($data, $status = 200) {
        return Response::json([
            'status'  => $status,
            'data' => $data,
            'error' => null
        ]);
    });

    Response::macro('error', function ($message, $status = 400) {
        return Response::json([
            'status'  => $status,
            'data' => null,
            'error' => $message,
        ], $status);
    });
  }
```

This provider has to be declared inside `config/app.php` inside `providers` array. 

```
'providers' => [
	...
        App\Providers\ResponseMacroServiceProvider::class,
    ],
```


**servicio-social-project/database/seeders/DatabaseSeeder.php**
Here we seed the application with some users

**servicio-social-project/routes/web.php**
Here we have ALL the routes so far. Why are they all in `web.php`? because web manages cookies and sessions, and allow us to be working with `Auth class` for example

We divide routes in two sections:
- The ones which return JSON (API)
```
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);
```

- The ones which return HTML (Views)
```
Route::get('/inicio', function () {
    return view('home_view');
})->middleware('auth')->name('home_view');

Route::get('/ingreso', function () {
    if(Auth::check()) return redirect()->route('home_view');
    else return view('login_view');
})->name('login_view');
```

---

#### Frontend

**servicio-social-project/resources**
*We'll take a look to all JS, CSS, HTML and assets involved in application. Here is basically the frontend of application*

**servicio-social-project/resources/css**
- `app.css` is the global css, is the css which every view has
- `Other css` are specific from a view or component

**servicio-social-project/resources/js**
- `app.js` is the global js, is the js which every view has
- `environment.js` the fake frontend environment file, so far is just declared the APP_URL (url of API)
- `Other js` are specific from a view or component

**servicio-social-project/resources/views**
Here are all views made of html and php which are going to be displayed to client
- `login_view, signup_view, portal_view, home_view, form_view` etc...

**servicio-social-project/resources/views/templates**
All html which can be inherited by any view or component
- `main_gobmx_template.blade.php`: is the global file of every view, is the most important and root of every view. This is inherited by every view

**servicio-social-project/resources/views/core-components**
All components which can be used in any part of application
- `navbar-component, alert-section, toast-section, topbar-environment`

**servicio-social-project/resources/views/simple-components**
All components used by any view, but do not have a general approach, they are specific
- `application-section, application-sections, application`
Note: `application` means Trámite

**servicio-social-project/resources/views/errors**
Custom views when there is a `404 http error` or `500 http error`

**servicio-social-project/resources/views/examples-gobmx**
Here we encounter the view and its components from everything has to do with the gobmx guide styles
**You must enter to this and take a look**, this is important because here you'll encounter everything how has to be done in the application 

---

**.env**

This file is not sent to github, and declares every needed key within whole Laravel application. 
So far we need to know about these ones:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:..  <-- this one will be different with you, does not matter
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ssdb
DB_USERNAME=root  <-- change this
DB_PASSWORD=abcd1234  <-- change this










