<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Update employee</title>
</head>
<body>
<section class="update-product">

<h1 class="heading">Add Balance </h1>

<form action="{{route('users.update', $user['id'] )}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')  
    <p>The balance for  {{$user['name']}}</p>
    <input type="number" min="0" max="300000" required placeholder="enter the balance" name="balance"  class="box">
    <div class="flex-btn">
        <a href="{{route('users.index')}}" class="option-btn option2">go back</a>
    </div>
    <input type="submit" value="Add Blance" class="btn" name="update">
</form>

</section>
</body>
</html>