@extends('layouts.app')

@section('row_title')
	Add an item
@endsection

@section('content')
    <h4>Any additional photoes?</h4>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_images') }}" enctype="multipart/form-data">
        <input type="hidden" value="{{ Session::token() }}" name="_token"> 
        <input type="hidden" value="{{ $item_id }}" name="item_id"> 
        @for($i = 1; $i <= 4; $i++)
            <div class="form-group">
                <label for="image{{ $i }}" class="col-md-4 control-label">Image {{ $i }}</label>
                <div class="col-md-6">
                    <input id="image{{ $i }}" type="file" name="image{{ $i }}">
                </div>
            </div>
        @endfor

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection