@extends('layouts.app')

@section('row_title')
    Dashboard
@endsection

@section('content')
	@if($sellItems->isEmpty() && $buyItems->isEmpty())
		<h4>No items to show in your dashboard</h4>
	@endif
	@if(!$sellItems->isEmpty())
		<h4>Items you are selling</h4>
	    <div class="row">
	        @foreach($sellItems as $item)
	            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
	                <a style="color:gray" class="thumbnail" href="{{ url('/items/' . $item->id) }}">
	                    <img class="img-responsive" src="{{ asset('images/item/') }}/{{ $item->image }}" alt="{{ $item->name }}">
	                    Name: {{ $item->name }}<br>
	                    Price: {{ number_format($item->price) }}<br>
	                    Category: {{ $item->category->name }}
	                    @if($item->is_sold) 
	                        <br><span style="color:red">Sold</span> 
	                    @endif
	                </a>
	            </div>
	        @endforeach
	    </div>
	@endif

	@if(!$sellItems->isEmpty() && !$buyItems->isEmpty())
		<hr>
	@endif

	@if(!$buyItems->isEmpty())
		<h4>Items you buyed</h4>
	    <div class="row">
	        @foreach($buyItems as $item)
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
