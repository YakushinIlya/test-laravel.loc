@extends('admin.app')

@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
        <div class="app-card-body">
            <form class="settings-form" method="post" action="{{route('admin.posts.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Заголовок</label>
                    <input type="text" name="head" class="form-control" id="setting-input-1" value="{{old('head')}}" required>
                </div>
                <div class="form-file mb-3">
                    <input type="file" name="image" class="form-file-input" id="customFile">
                    <label class="form-file-label" for="customFile">
                        <span class="form-file-text">Выберите изображение записи</span>
                        <span class="form-file-button">Выбрать</span>
                    </label>
                </div>
                <div class="mb-3">
                    <label for="setting-input-7" class="form-label">Категории статьи</label>
                    <select name="category" class="form-control" id="setting-input-7" required>
                        <option disabled selected>-- Выберите категорию --</option>
                        @foreach($categories as $category)
                            <option value="{{$category['id']}}" @if($category['id']==old('category')) selected @endif>{{$category['head']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn app-btn-primary">Сохранить</button>
            </form>
        </div><!--//app-card-body-->
    </div>
@endsection
