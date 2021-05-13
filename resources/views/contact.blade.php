@extends('layouts.app')
@section('title', 'Обратная связь')

@section('content')
    <h1>Мои запросы:</h1>
    <div class="col-12 col-md-30">
        <table class="table">
            <thead>
            <tr>

                <th scope="col">Тема</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Файл</th>
                <th scope="col">Время создания</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <th scope="row">{{ $contact->topic }}</th>
                    <td>{{ $contact->message}}</td>
                    <td><a href="{{'/path/' . $contact->file}}" target="_blank">{{ $contact->file }}</a></td>
                    <td>{{ $contact->created_at }}</td>
                    <th>

                        <a href="/contact/showMessage"><button type="button" class="btn btn-success">Выполнено</button></a>

                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div >
    <h1>Создать новый запрос:</h1>
    <form  class="form-horizontal" method="POST" action="{{ route('contact-form') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div  class="form-group">
            <label for="Topic">Тема: </label>
            <input type="text" class="form-control" id="topic" placeholder="Тематика обращения" name="topic">
        </div>

        <div class="form-group">
            <label for="message">Сообщение: </label>
            <textarea type="text" class="form-control luna-message" id="message" placeholder="Текст обращения"
                      name="message"></textarea>
        </div>

        <div class="form-group">
            <label for="Topic">Файл: </label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" value="Send">Отправить</button>
        </div>
    </form>

@endsection
