<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/soft-delete', function (Post $post) {
    $post->destroy(6);

    $posts = $post->get();

    return $posts;
});

Route::get('/delete', function (Post $post) {
    // $post = $post->destroy(Post::get());
    $post = $post->where('id', 1)->first();

    if (!$post)
        return 'Post Not Found';

    dd($post->delete());
});

Route::get('/update', function () {
    if (!$post = Post::find(1))
        return 'Post Not Found';

    $post->title = 'Título atualizado!';
    $post->save();
    dd($post);
});

Route::get('/insert2', function (Post $post) {
    $post = $post->create([
        'user_id'   => 1,
        'title'     => Str::random(15),
        'body'      => Str::random(150),
        'date'      => date('Y-m-d'),
    ]);

    dd($post);
});


Route::get('/insert', function (Post $post, Request $request) {

    $post->user_id  = 1;
    $post->title    = 'Primeiro Post'. Str::random(5);
    $post->body     = 'Conteúdo do primeiro post';
    $post->date     = date('Y-m-d');

    // dd($post);
    $post->save();

    $posts = $post->get();

    return $posts;
});

Route::get('/order', function (User $user) {
    $users = $user->orderBy('id', 'DESC')->get();

    // dd($users);

    return $users;
});

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
