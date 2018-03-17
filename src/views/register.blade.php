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
	@if (session()->has('status'))
		<div class="alertForm fail">
		       <p>{{ session('status') }}</p>
		   </div>
		</div>
	@endif
	<form method="post" action="{{ url('register') }}">
		{{ csrf_field() }}
		email <input name="email" type="text" value="{{ old('email') }}"><br>
		password <input name="password" type="password"><br>
		password confirmation <input name="password_confirmation" type="password"><br>
		name <input name="name" type="text" value="{{ old('name') }}" ><br>
		<button type="submit">Submit</button>
	</form>
</body>
</html>