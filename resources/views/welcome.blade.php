@extends('layouts.app')

@section('row_title')
    Welcome
@endsection

@section('content')
    <div>
        <form class="form-inline" role="form" method="POST" action="{{ url('/search') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="category_id">Looking for</label>
                <select id="category_id" class="form-control" name="category_id">
                    <option value="all">All</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id"> in </label>
                <select id="city_id" class="form-control" name="city_id">
                    <option value="all">All</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-default">Go</button>
        </form>
    </div>

    <hr>
    
    @if($items->isEmpty())
        <h4>No items to show</h4>
    @else
        <h4>Items for sale</h4>
        <div class="row">
            @foreach($items as $item)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="height:350px">
                    <a style="color:gray" class="thumbnail" href="{{ url('/items/' . $item->id) }}">
                        <img class="img-responsive" src="{{ asset('images/item/') }}/{{ $item->image }}" alt="{{ $item->name }}">
                        Name: {{ $item->name }}<br>
                        Price: {{ number_format($item->price) }}<br>
                        Category: {{ $item->category->name }}
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
