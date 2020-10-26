@extends('layouts.app')

@section('title', 'Изменить данные должника'.$debt->id)

@section('content')
<div class="row">
  <div class="col-lg-6 mx-auto">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

  <form method="POST" action="{{ url('update/'.$debt->id) }}">
    @csrf
  <div class="form-group">
    <label for="post-lastname">Фамилия</label>
    <input value="{{ $debt->lastname }}" type="text" name="lastname" class="form-control" id="post-lastname">
  </div>
  <div class="form-group">
    <label for="post-firstname">Имя</label>
    <input value="{{ $debt->firstname }}" type="text" name="firstname" class="form-control" id="post-firstname">
  </div>
  <div class="form-group">
    <label for="post-secondname">Отчество</label>
    <input value="{{ $debt->secondname }}" type="text" name="secondname" class="form-control" id="post-secondname">
  </div>
  <div class="form-group">
    <label for="post-debt">Сумма долга</label>
    <input value="{{ $debt->debt }}" type="text" name="debt" class="form-control" id="post-debt">
  </div>
  <button type="submit" class="btn btn-success">Обновить</button>
</form>
</div>
</div>
@endsection
