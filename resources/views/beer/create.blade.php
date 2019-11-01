@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="box">
                            <form  action="{{route('beer.action.store')}}" method="POST">
                                @csrf
                                <div class="box-header with-border">
                                    <h3 class="box-title">Добавить пиво</h3>

                                </div>
                                <div class="box-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Название</label>
                                            <input name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Описание</label>
                                            <input name="description" type="text" class="form-control" value="{{ old('description') }}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="manufacturer">Производитель</label>
                                            <select name="manufacturer_id" class="form-control" id="manufacturer">
                                                @foreach($manufacturers as $mKey => $mItem)
                                                    <option value="{{ $mKey }}">{{ $mItem }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Тип пива</label>
                                            <select name="type_id" class="form-control" id="type">
                                                @foreach($typeBeers as $tKey => $tItem)
                                                    <option value="{{ $tKey }}">{{ $tItem }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('beer.errors')
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button class="btn btn-default"><a href="{{ route('beer.action.index') }}" >Назад</a></button>
                                    <button class="btn btn-success pull-right">Добавить</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
