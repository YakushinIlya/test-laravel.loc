@extends('admin.app')

@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <section class="app-card-body p-3">
            <article>
                <img src="{{$post['image']}}" class="img-thumbnail img-fluid">
            </article>
            <section class="mt-5">
                <div>
                    Категория: <a href="{{route('post.category', ['id'=>$post->categories->id])}}">{{$post->categories->head}}</a>
                </div>
                <div>
                    Автор: <a href="{{route('post.author', ['id'=>$post->users->id])}}">{{$post->users->email}}</a>
                </div>
            </section>
        </div>
    </div>
@endsection
