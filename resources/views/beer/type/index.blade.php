@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-tooggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('beer.types.create')  }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <h1>Типы пива</h1>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('beer.types.edit', $item->id) }}">
                                            {{ $item->title  }}
                                        </a>
                                    </td>
                                    <td>
                                        <form  action="{{route('beer.types.destroy', $item->id)}}" method="POST">
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
        @if( $paginator->total() > $paginator->count() )
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


@endsection
