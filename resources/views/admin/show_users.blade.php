@if(Auth::guest() || !(Auth::user()->is_admin))
     <script type="text/javascript">
		window.location = "{{ url('/home') }}";
	</script> 
@endif

@extends('layouts.app')

@section('row_title')
	Users
@endsection

@section('content')
	<table class="table table-striped">
		<thead class="thead">
			<tr>
	            <th scope="row">Username</th>
	            <th scope="row">Email</th>
	            <th scope="row">City</th>
	            <th scope="row">Address</th>
	            <th scope="row">Cellphone</th>
	            <th scope="row">Admin / User</th>
	            <th scope="row">Delete</th>

	        </tr>
        </thead>

 	@foreach($users as $user)
 		@if(Auth::user()->id === $user->id)
 			<td> {{ $user->name }} </td>
 			<td> {{ $user->email }} </td>
            <td> {{ $cities->find($user->city_id)->name }} </td>
            <td> {{ $user->address }} </td>
            <td> {{ $user->cellphone }} </td>
            <td>
				@if($user->is_admin === 1)
					Admin
				@else
					Super admin
				@endif
            </td>
            <td><div class="btn btn-default disabled">Delete</div></td>
 		@else
			<tr>
				<td> {{ $user->name }} </td>
	            <td> {{ $user->email }} </td>
	            <td> {{ $cities->find($user->city_id)->name }} </td>
	            <td> {{ $user->address }} </td>
	            <td> {{ $user->cellphone }} </td>
	            <td>
	            	@if(Auth::user()->is_admin === 2)
		            	<form method="POST" action="{{ url('/admin/show_users') }}">
		            		<input type="hidden" value="{{ Session::token() }}" name="_token">
		            		<input type="hidden" value="{{ $user->id }}" name="id">
		            		<button type="submit" class="btn btn-default " name="admin_btn">
		            			@if($user->is_admin === 0)
		            				User
		            			@else
		            				@if($user->is_admin === 1)
		            					Admin
		            				@else
		            					Super admin
		            				@endif
		            			@endif
		            		</button>
		            	</form>
		            @else
		            	@if($user->is_admin === 0)
            				User
            			@else
            				@if($user->is_admin === 1)
            					Admin
            				@else
            					Super admin
            				@endif
            			@endif
        			@endif
	            </td>
	            <td>
	            	@if((Auth::user()->is_admin === 2) || ((Auth::user()->is_admin === 1) && ($user->is_admin === 0)))
		            	<form method="POST" action="{{ url('/admin/show_users') }}">
		            		<input type="hidden" value="{{ Session::token() }}" name="_token">
		            		<input type="hidden" value="{{ $user->id }}" name="id">
		            		<button type="submit" class="btn btn-default " name="delete_btn">Delete</button>
		            	</form>
		            @else
	            		<div class="btn btn-default disabled">Delete</div>
	            	@endif
	            </td>
			</tr>
		@endif
	@endforeach
 	</table>
@endsection