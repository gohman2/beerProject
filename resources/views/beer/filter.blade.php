<form action="{{route('beer.action.index')}}" method="GET">
    <div class="box-body">
        <div class="col-md-12">
            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <label for="manufacturer">Производитель</label>
                                    <select name="manufacturer_id" class="form-control" id="manufacturer">
                                        @foreach($manufacturers as $mKey => $mItem)
                                            @if($mId == $mKey)
                                                <option selected value="{{ $mKey }}">{{ $mItem }}</option>
                                            @else
                                                <option value="{{ $mKey }}">{{ $mItem }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <label for="type">Тип пива</label>
                                    <select name="type_id" class="form-control" id="type">
                                        @foreach($typeBeers as $tKey => $tItem)
                                            @if($tId == $tKey)
                                                <option selected value="{{ $tKey }}">{{ $tItem }}</option>
                                            @else
                                                <option value="{{ $tKey }}">{{ $tItem }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <button class="btn btn-success pull-right">Выбрать</button>
                                    <button class="btn btn-light pull-right"><a href="{{ route('beer.action.index') }}">Сбросить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
