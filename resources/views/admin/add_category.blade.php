@if(Auth::guest() || !(Auth::user()->is_admin))
     <script type="text/javascript">
		window.location = "{{ url('/home') }}";
	</script> 
@endif

@extends('layouts.app')

@section('row_title')
	Add a category
@endsection

@section('content')
	    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/add_category') }}">
        <input type="hidden" value="{{ Session::token() }}" name="_token"> 

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Category name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection