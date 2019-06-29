@extends('layouts.app')

@section('row_title')
	Add an item
@endsection

@section('content')
	<h4>Step 2</h4>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_detail_item') }}">
        <input type="hidden" value="{{ Session::token() }}" name="_token"> 
        <input type="hidden" value="{{ $item->id }}" name="item_id"> 
		@foreach($details as $detail)
			@foreach($cat_dets as $cat_det)
				@if($detail->id === $cat_det->detail_id)
			        <div class="form-group">
			            <label for="{{ $detail->id }}" class="col-md-4 control-label">{{ $detail->name }}</label>
			            <div class="col-md-6">
			                <input id="{{ $detail->id }}" type="text" class="form-control" name="{{ $detail->id }}" required>
			            </div>
			        </div>
				@endif
			@endforeach
		@endforeach

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-default">
                    Next
                </button>
            </div>
        </div>
    </form>
@endsection



