@extends('admin.app')

@section('content')
    <a href="{{route('admin.users.create')}}" class="btn btn-primary text-white mb-3">Создать пользователя</a>

    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body p-3">
            @isset($users)
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                        <tr>
                            <th class="cell">#id</th>
                            <th class="cell">E-mail</th>
                            <th class="cell">Роль</th>
                            <th class="cell">Act.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="cell">{{$user["id"]}}</td>
                                <td class="cell">{{$user["email"]}}</td>
                                <td class="cell">{{$user->role[0]->head}}</td>
                                <td class="cell text-center">
                                    <form action="{{route('admin.users.delete', ['id'=>$user["id"]])}}" method="POST">
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
                    {!! $users->links() !!}
                </div>
            @else
                <div class="alert alert-warning">Ничего не найдено</div>
            @endisset
        </div>
    </div>
@endsection
