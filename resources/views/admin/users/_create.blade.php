@extends('admin.app')

@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
        <div class="app-card-body">
            <form class="settings-form" method="post" action="{{route('admin.users.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="setting-input-1" value="{{old('email')}}" required>
                </div>
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="setting-input-1" required>
                </div>
                <div class="mb-3">
                    <label for="setting-input-7" class="form-label">Роль пользователя</label>
                    <select name="role" class="form-control" id="setting-input-7" required>
                        <option disabled selected>-- Выберите роль --</option>
                        @foreach($roles as $role)
                            <option value="{{$role['id']}}" @if($role['id']==old('role')) selected @endif>{{$role['head']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn app-btn-primary">Сохранить</button>
            </form>
        </div><!--//app-card-body-->
    </div>
@endsection
