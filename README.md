##1. Estructura del Proyecto
bash
Copiar código
cd /var/www/html/laraveles/
sudo composer create-project laravel/laravel bancoPokemon
cd bancoPokemon/
sudo chown -R ubuntu:www-data /var/www/html/laraveles/
sudo chmod -R 775 /var/www/html/laraveles/
Asegúrate de tener el repositorio clonado:

bash
Copiar código
cd /var/www/html/laraveles/
git clone https://github.com/dwesizv/traditionalLaravelApp.git
cd bancoPokemon/
composer install
php artisan key:generate
Configuración de la base de datos:
Edita el archivo .env para que se conecte a tu base de datos:

bash
Copiar código
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombreBaseDatos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
Luego, ejecuta las migraciones:

bash
Copiar código
php artisan migrate
Copia la carpeta assets a public y crea las vistas necesarias en resources/views (bank y main).

##2. Controladores
MainController.php
php
Copiar código
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function login(Request $request)
    {
        $request->session()->flash('message', 'User logged in');
        $request->session()->put('user', true);
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->flash('message', 'User logged out');
        $request->session()->forget('user');
        return redirect()->back();
    }

    public function main()
    {
        return view('main.main', ['activeHome' => 'active']);
    }
}
PokemonController.php
php
Copiar código
<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();
        return view('bank.index', compact('pokemons'));
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        Pokemon::create($request->all());
        return redirect()->route('pokemon.index');
    }

    public function show(Pokemon $pokemon)
    {
        return view('bank.show', compact('pokemon'));
    }

    public function edit(Pokemon $pokemon)
    {
        return view('bank.edit', compact('pokemon'));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $pokemon->update($request->all());
        return redirect()->route('pokemon.index');
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('pokemon.index');
    }
}
##3. Rutas (web.php)
php
Copiar código
<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('login', [MainController::class, 'login'])->name('login');
Route::get('logout', [MainController::class, 'logout'])->name('logout');
Route::resource('pokemon', PokemonController::class);
Si es necesario habilitar el módulo de reescritura y reiniciar Apache:

bash
Copiar código
sudo nano /etc/apache2/apache2.conf
# <Directory /var/www/>
# AllowOverride All

sudo a2enmod rewrite
sudo service apache2 restart
## 4. Vistas
main.blade.php
php
Copiar código
@extends('base')

@section('title', 'Banco Pokémon')

@section('content')
    @if(session('user'))
        <a href="{{ url('logout') }}" class="btn btn-primary">Logout</a>
    @else
        <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
    @endif
    &nbsp;
    <a href="{{ url('pokemon') }}" class="btn btn-primary">Banco de Pokémon</a>
@endsection
Vista index.blade.php para mostrar los Pokémon
php
Copiar código
@extends('base')

@section('title', 'Listado de Pokémon')

@section('content')
    <h1>Lista de Pokémon</h1>
    <a href="{{ route('pokemon.create') }}" class="btn btn-success">Agregar Nuevo Pokémon</a>
    <table id="pokemonTable" class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemons as $pokemon)
                <tr>
                    <td>{{ $pokemon->name }}</td>
                    <td>{{ $pokemon->type }}</td>
                    <td>
                        <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('pokemon.show', $pokemon) }}" class="btn btn-info">Ver</a>
                        <a href="#" class="btn btn-danger delete-link" data-url="{{ route('pokemon.destroy', $pokemon) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteForm" method="POST" style="display: none;">
        @method('DELETE')
        @csrf
    </form>
@endsection
##5. Script JavaScript
En public/assets/js/script.js:

javascript
Copiar código
(function () {

    let table = document.getElementById('pokemonTable');

    if (table) {
        table.addEventListener('click', handleTableClick);
    }

    function handleTableClick(event) {
        const deleteForm = document.getElementById('deleteForm');
        let target = event.target;
        if (target.tagName === 'A' && target.classList.contains('delete-link')) {
            event.preventDefault();
            if (confirm('¿Estás seguro de que quieres eliminar este Pokémon?')) {
                let url = target.dataset.url;
                deleteForm.action = url;
                deleteForm.submit();
            }
        }
    }

})();

## 6. Ajustes de Seguridad en Apache
Asegúrate de que AllowOverride All esté habilitado en tu archivo de configuración de Apache para permitir que .htaccess se utilice en el proyecto.

Este código proporciona una estructura básica para la aplicación bancaria de Pokémon en Laravel, con todas las funcionalidades necesarias para el CRUD.




