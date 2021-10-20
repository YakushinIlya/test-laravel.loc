@extends('admin.app')

@section('content')
    <a href="{{route('admin.posts.create')}}" class="btn btn-primary text-white mb-3">Создать запись</a>

    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body p-3">
            @isset($posts)
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                        <tr>
                            <th class="cell">#id</th>
                            <th class="cell">Изображение</th>
                            <th class="cell">Заголовок</th>
                            <th class="cell">Категория</th>
                            <th class="cell">Act.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="cell">{{$post["id"]}}</td>
                                <td class="cell">
                                    <img src="{{$post["image"]}}" width="50px">
                                </td>
                                <td class="cell">{{$post["head"]}}</td>
                                <td class="cell">{{$post->categories->head}}</td>
                                <td class="cell text-center">
                                    <form action="{{route('admin.posts.delete', ['id'=>$post["id"]])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger btn-block">Удалить</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
                <div class="mt-3">
                    {!! $posts->links() !!}
                </div>
            @else
                <div class="alert alert-warning">Ничего не найдено</div>
            @endisset
        </div>
    </div>
@endsection
