@extends('layouts.app')

@section('row_title')
	Contact us
@endsection

@section('content')
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/add_city') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="subject" class="col-md-4 control-label">Subject</label>
            <div class="col-md-6">
                <input id="subject" type="text" class="form-control" name="subject">
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-md-4 control-label">Message</label>
            <div class="col-md-6">
            	<textarea id="message" type="text" class="form-control" name="message"></textarea>
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



