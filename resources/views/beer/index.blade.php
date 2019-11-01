@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-tooggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('beer.action.create')  }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <h1>Пиво</h1>
                        <form  action="{{route('beer.action.index')}}" method="GET">
                            @csrf
                            <div class="box-header with-border">
                                <h3 class="box-title">Добавить пиво</h3>

                            </div>
                            <div class="box-body">
                                <div class="col-md-6">
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
                                <button class="btn btn-success pull-right">Выбрать</button>
                            </div>

                        </form>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Производитель</th>
                                <th>Тип пива</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($beers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('beer.action.edit', $item->id) }}">
                                            {{ $item->title  }}
                                        </a>
                                    </td>
                                    <td>{{ $item->description  }}</td>
                                    <td>{{ $item->getManufacturerTitle()  }}</td>
                                    <td>{{ $item->getTypeBeerTitle()  }}</td>
                                    <td>
                                        <form  action="{{route('beer.action.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Вы уверенны?')" type="submit" class="delete">
                                                <i>Удалить</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if( $beers->total() > $beers->count() )
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $beers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


@endsection
