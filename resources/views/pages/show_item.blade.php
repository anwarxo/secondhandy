@extends('layouts.app')

@section('row_title')
	Show an item
@endsection

@section('content')
    @if($item->is_sold === 1)
        <p class="bg-danger">This item is sold!</p>
    @endif
    <div class="col-md-4">
        <table class="table table-striped">
            <tr>
                <td><span class="text-muted">Name</span></td>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <td><span class="text-muted">Price</span></td>
                <td>{{ number_format($item->price) }}</td>
            </tr>
            <tr>
                <td><span class="text-muted">Category</span></td>
                <td>{{ $item->category->name }}</td>
            </tr>
            @if(strlen($item->description) !== 0)
                <tr>
                    <td><span class="text-muted">Description</span></td>
                    <td>{{ $item->description }}</td>
                </tr>
            @endif
            @foreach($details as $detail)
                @foreach($detail_items as $detail_item)
                    @if($detail_item->detail_id === $detail->id)
                        <tr>
                            <td><span class="text-muted">{{ $detail->name }}</span></td>
                            <td>{{ $detail_item->value }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            <tr>
                <td><span class="text-muted">Seller's name</span></td>
                <td>{{ $seller->name }}</td>
            </tr>
            <tr>
                <td><span class="text-muted">Seller's email</span></td>
                <td>{{ $seller->email }}</td>
            </tr>
            <tr>
                <td><span class="text-muted">Seller's phone</span></td>
                <td>{{ $seller->cellphone }}</td>
            </tr>
        </table>
        @if( Auth::guest() || 
            (Auth::user()->id === $item->seller_id) ||
            $item->is_sold === 1
        )
            <div class="btn btn-primary disabled">Buy</div>
        @else
            <form method="POST" action="{{ url('/items/' . $item->id) }}">
                {{ csrf_field() }}
                <button class="btn btn-primary">Buy</button>
            </form>
        @endif

        @if( !Auth::guest() && 
            !$item->is_sold && 
            (Auth::user()->is_admin || Auth::user()->id === $item->seller_id)
        )
            <form method="POST" action="{{ url('/home') }}">
                {{ csrf_field() }}
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button class="btn btn-danger" style="margin-top:10px">Delete</button>
            </form>
        @endif
        
    </div>

    <div class="col-md-6 col-md-offset-1" style="margin:20px">
        <a href="{{ asset('images/item') }}/{{ $item->image }}">
            <img src="{{ asset('images/item') }}/{{ $item->image }}" alt="{{ $item->name }}" class="img-rounded img-responsive">
        </a>
    </div>
    
    <div class="row" style="margin:20px">
        @foreach($item->images as $image)
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="{{ asset('images/item/' . $item->id) }}/{{ $image->image }}">
                    <img class="img-responsive" src="{{ asset('images/item/' . $item->id) }}/{{ $image->image }}" alt="{{ $item->name }}">
                </a>
            </div>
        @endforeach
    </div>
@endsection