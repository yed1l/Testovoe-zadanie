@extends('layouts.app')
@section('title', 'Ответ')

@section('content')
    <div class="col-12 col-md-30">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Тема</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Имя клиента</th>
                <th scope="col">Почта клиента</th>
                <th scope="col">Файл</th>
                <th scope="col">Время создания</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <th scope="row">{{ $topic->topic }}</th>
                    <td>{{ $topic->message}}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->email }}</td>
                    <td><a href="{{'/path/' . $topic->file}}" target="_blank">{{ $topic->file }}</a></td>
                    <td>{{ $topic->created_at }}</td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <form method="post" action="{{ route('submit',$topic->id) }}">
        @csrf
        <div class="row">
            <h1>Сообщение:</h1>
            <div class="col-sm-12">
                <textarea name="comment" rows="2" class="text-area-messge form-control"
                                                  placeholder="Enter your message" aria-required="true" aria-invalid="false"></textarea >
            </div><!-- col-sm-12 -->
            <div class="col-sm-12">
                <button class="submit-btn" type="submit" id="form-submit"><b>Отправить</b></button>
            </div><!-- col-sm-12 -->

        </div><!-- row -->
    </form>

@endsection
