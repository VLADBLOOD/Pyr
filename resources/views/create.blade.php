@extends('layouts.app')

@section('title', 'Добавить потребителя')

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

  <form method="POST" action="/publicate">
    @csrf
  <div class="form-group">
    <label for="post-lastname">Фамилия</label>
    <input value="{{ old('lastname') }}" type="text" name="lastname" class="form-control" id="post-lastname">
  </div>
  <div class="form-group">
    <label for="post-firstname">Имя</label>
    <input value="{{ old('firstname') }}" type="text" name="firstname" class="form-control" id="post-firstname">
  </div>
  <div class="form-group">
    <label for="post-secondname">Отчество</label>
    <input value="{{ old('secondname') }}" type="text" name="secondname" class="form-control" id="post-secondname">
  </div>
  <div class="form-group">
    <label for="post-debt">Сумма долга</label>
    <input value="{{ old('debt') }}" type="text" name="debt" class="form-control" id="post-debt">
  </div>
  <button type="submit" class="btn btn-success">Добавить должника</button>
</form>
</div>
</div>
@endsection
