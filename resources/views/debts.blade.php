@extends('layouts.app')

@section('title', 'Потребители')

@section('content')
    <!-- Панель кнопок -->
    @include('common.buttons_panel')

    <!-- Проверка на заполнение -->
    @if(session()->get('success'))
        <div class="alert alert-success mt-3">
            {{ session()->get('success') }}
        </div>
    @endif

    <!-- Грид -->
    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Отчество</th>
            <th scope="col">Сумма долга</th>
            <th scope="col">Госпошлина</th>
            <th class="table-buttons" scope="col">Инструменты</th>
        </tr>
        </thead>
        <tbody>
        @foreach($debts as $debt)
            <tr>
                <th scope="row">{{ $debt->id }}</th>
                <td><a href="{{ url('/view/pdf', $debt->id) }}">{{ $debt->lastname }} <i class="far fa-eye"></i></a></td>
                <td>{{ $debt->firstname }}</td>
                <td>{{ $debt->secondname }}</td>
                <td>{{ $debt->debt }}</td>
                <td>{{ $debt->statefee }}</td>
                <td class="table-buttons">
                    <!-- Кнопки редактирования -->
                    <a href="{{ url('/upload/pdf', $debt->id) }}" class="btn btn-info"><i class='fas fa-download'></i></a>
                    <a href="{{ url('/download/pdf', $debt->id) }}" class="btn btn-info"><i class='fas fa-upload'></i></a>
                    <a href="{{ url('/export/pdf', $debt->id) }}" class="btn btn-success"><i class='far fa-file-pdf'></i></a>
                    <a href="{{ url('/edit', $debt->id) }}" class="btn btn-primary"><i class='fas fa-pen'></i></a>
                    <form action="{{ url('debt/'.$debt->id) }}" method="POST" >
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class='fas fa-trash-alt'></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
