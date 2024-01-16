<?php

use App\Scopes\YearScope;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


Route::get('/observer', function (Post $post) {
    $post = $post->create([
        'title' => Str::random(100),
        'body'  => Str::random(200),
        'date'  => now()
    ]);

    return $post;
});

Route::get('/global-scopes', function (Post $post) {
    // $posts = $post->get();
    $posts = $post->withoutGlobalScope(YearScope::class)->get();

    return $posts;
});

Route::get('/anonymous-global-scopes', function (Post $post) {
    // $posts = $post->get();
    $posts = $post->withoutGlobalScope('year')->get();

    return $posts;
});

Route::get('/local-scope', function (Post $post) {
    // $posts = $post->last_week()->get();
    // $posts = $post->today()->get();

    $posts = $post->between('2024-01-01', '2024-12-31')->get();

    return $posts;
});

Route::get('/mutators', function (User $user, Post $post) {
    $user = $user->first();

    $post = new Post([
        'title'     => 'Novo Titulo ' . Str::random(10),
        'body'      => 'Conteúdo do post: ' . Str::random(150),
        'date'      => now(),
    ]);

    $user->posts()->save($post);

    return $post;
});

Route::get('/acessors', function (Post $post) {
    $posts = $post->first();

    return $posts;
});

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
