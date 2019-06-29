@if(Auth::guest() || !(Auth::user()->is_admin))
    <script type="text/javascript">
		window.location = "{{ url('/home') }}";
	</script> 
@endif

@extends('layouts.app')

@section('row_title')
	Connect details with a category
@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/connect_category_detail') }}">
        <input type="hidden" value="{{ Session::token() }}" name="_token"> 

        <div class="form-group">
            <label for="category_id" class="col-md-4 control-label">Category</label>
            <div class="col-md-6">
                <select id="category_id" class="form-control" name="category_id">
                    @foreach($categories as $category)
                        @unless($category->id === 1)
                            <option value= "{{  $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endunless
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="detail_id" class="col-md-4 control-label">Detail</label>
            <div class="col-md-6">
                <select id="detail_id" class="form-control" name="detail_id">
                    @foreach($details as $detail)
                        <option value= "{{  $detail->id }}">
                            {{ $detail->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- <div class="form-group">
            <label for="detail_id" class="col-md-4 control-label">Details</label>
            <div class="col-md-6">
                @foreach($details as $detail)
                    <div class="checkbox">
                        <label>
                            <input id="detail_id" type="checkbox" name="{{ $detail->id }}" value="{{ $detail->id }}"> {{ $detail->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection