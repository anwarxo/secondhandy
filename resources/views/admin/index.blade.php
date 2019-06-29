@if(Auth::guest() || !(Auth::user()->is_admin))
     <script type="text/javascript">
		window.location = "{{ url('/home') }}";
	</script> 
@endif

@extends('layouts.app')

@section('row_title')
	Control panel
@endsection

@section('content')
	<ul>
    	<li><a href="{{ url('/admin/show_users') }}">Show users</a></li>
    	<li><a href="{{ url('/admin/add_city') }}">Add a city</a></li>
        <li><a href="{{ url('/admin/add_category') }}">Add a category</a></li>
    	<li><a href="{{ url('/admin/add_detail') }}">Add a detail</a></li>
    	<li><a href="{{ url('/admin/connect_category_detail') }}">Connect a detail with a category</a></li>
    <ul>
@endsection