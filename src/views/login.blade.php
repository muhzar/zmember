<!DOCTYPE html>
<html>
<head>
	<title>Member</title>
</head>
<body>
	@if (isset($errors) && count($errors) > 0)
		<div class="alertForm fail">
	   	<ul>
	       	@foreach ($errors->all() as $error)
	        	<li><p>{{ $error }}</p></li>
	       	@endforeach
	   	</ul>
	</div>
	@endif

	@if (session()->has('error'))
		<div class="alertForm fail">
		       <p>{{ session('error') }}</p>
		   </div>
		</div>
	@endif
	<form method="post"  action="{{ url('login') }}">
		{{ csrf_field() }}
		email <input name="email" type="text" value="{{ old('email') }}"><br>
		password <input name="password" type="password"><br>
		<button type="submit">Submit</button><br>
		or<br>
		<a href="{{ url('login/facebook') }}">facebook</a><br>
		<a href="{{ url('login/google') }}">google</a><br>
		<a href="{{ url('login/twitter') }}">twitter</a><br>
	</form>
</body>
</html>