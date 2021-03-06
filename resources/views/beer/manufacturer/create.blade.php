@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="box">
                            <form  action="{{route('beer.manufacturers.store')}}" method="POST">
                                @csrf
                                <div class="box-header with-border">
                                    <h3 class="box-title">Добавляем производителя</h3>
{{--                                    @include('admin.errors')--}}
                                </div>
                                <div class="box-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Название</label>
                                            <input name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="">
                                        </div>
                                        @include('beer.errors')
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button class="btn btn-default"><a href="{{ route('beer.manufacturers.index') }}" >Назад</a></button>
                                    <button class="btn btn-success pull-right">Добавить</button>
                                </div>
                                <!-- /.box-footer-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
