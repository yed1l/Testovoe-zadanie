@extends('layouts.app')
@section('title', 'Панель управления')

@section('content')
    <div class="col-12 col-md-30">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Тема</th>
            <th scope="col">Сообщение</th>
            <th scope="col">Имя клиента</th>
            <th scope="col">Почта клиента</th>
            <th scope="col">Файл</th>
            <th scope="col">Время создания</th>
            <th scope="col">Статус</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($topics as $topic)
        <tr>
            <th scope="row">{{ $topic->id }}</th>
            <td>{{ $topic->topic }}</td>
            <td>{{ $topic->message}}</td>
            <td>{{ $topic->name }}</td>
            <td>{{ $topic->email }}</td>
            <td><a href="{{'/path/' . $topic->file}}" target="_blank">{{ $topic->file }}</a></td>
            <td>{{ $topic->created_at }}</td>
            <th>
                @if($topic->status == false)
                    <a href="/panel/update/{{ $topic->id }}"><button type="button" class="btn btn-primary">Не посмотренно</button></a>
                @else
                    <button type="button" class="btn btn-success">Выполнено</button>
                @endif
            </th>
            <th>
                <a href="/panel/comment/{{$topic->id}}"><button type="button" class="btn btn-primary">Ответить</button></a>
            </th>

        </tr>
        @endforeach
        </tbody>
    </table>

    </div>
@endsection
