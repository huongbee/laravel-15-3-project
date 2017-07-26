<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Import Excel</title>
	<link rel="stylesheet" href="">
</head>
<body>
<h1>Import</h1>
	<form action="{{route('import')}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="file" name="file">
		<br><br>
		<button type="submit" name="gui">Import</button>
	</form>

<h2>Export table demo_excel</h2>
	<form action="{{route('export')}}" method="POST" accept-charset="utf-8" >
		{{csrf_field()}}
		<button type="submit" name="gui">Export</button>
	</form>
</body>
</html>