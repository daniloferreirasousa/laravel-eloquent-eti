<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/pagination', function(User $user) {
    $filter = request('name');
    $totalPage = request('paginate', 10);

    $users = $user->where('name', 'LIKE', "%{$filter}%")->paginate($totalPage);

    return $users;
});

Route::get('/where', function () {

    $filterOne = 'be';
    $filter = 'Da';

    // $users = User::where('name', '<>', 'Danilo')->get();
    // $users = User::findOrFail(request('id'));
    $users = User::where('name', 'LIKE', "%{$filterOne}%")
                    ->orWhere(function ($query) use($filter) {
                        $query->where('name', 'LIKE', "%{$filter}%");
                    })
                    ->get();

    dd($users);
});

Route::get('/select', function () {
    $users = User::where('id', 1)->get()->first();

    dd($users);
});

Route::get('/', function () {
    return view('welcome');
});
