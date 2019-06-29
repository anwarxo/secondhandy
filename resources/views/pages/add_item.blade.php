@if(Auth::guest())
    <script type="text/javascript">
		window.location = "{{ url('/login') }}";
	</script> 
@endif

@extends('layouts.app')

@section('row_title')
	Add an item
@endsection

@section('content')
    <h4>Step 1</h4>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_item') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{-- <input type="hidden" value="{{ Session::token() }}" name="_token">  --}}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Item name</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('categoty_id') ? ' has-error' : '' }}">
            <label for="categoty_id" class="col-md-4 control-label">Category</label>
            <div class="col-md-6">
                <select id="category_id" class="form-control" name="category_id" value="{{ old('category_id') }}">
                     @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('categoty_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoty_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="price" class="col-md-4 control-label">Price</label>
            <div class="col-md-6">
                <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">
                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>
            <div class="col-md-6">
                <textarea id="description" type="textarea" class="form-control" name="description" value="{{ old('description') }}"></textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="col-md-4 control-label">Image</label>
            <div class="col-md-6">
                <input id="image" type="file" name="image" value="{{ old('image') }}">
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button name="next1" type="submit" class="btn btn-default">
                    Next
                </button>
            </div>
        </div>
    </form>
@endsection