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

<h1 class="heading">update product</h1>

<form action="{{route('admins.update', $employee['id'] )}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put') 
    <img src="../../images/{{$employee->img}}" name="img" alt="">
    <span>update name</span>
    <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="{{$employee->name}}">
    <span>update number</span>
    <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="{{$employee->number}}">
    <span>update email</span>
    <input type="email"  placeholder="enter email " name="email" class="box" value="{{$employee->email}}" required>
        @error('email')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <span>update location</span>
    <input type="text"  placeholder="enter location " name="address" class="box" value="{{$employee->address}}" required>
        @error('address')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
    <span>update role</span>
    <select name="role" class="box" >
            <option disabled selected>select role --</option>
            <option value="chief">chief</option>
            <option value="employee">employee</option>
            <option value="delivery">delivery</option>
        </select>
        @error('role')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
    <div class="flex-btn">
        <a href="{{route('admins.index')}}" class="option-btn option2">go back</a>
    </div>
    <input type="submit" value="update" class="btn" name="update">
</form>

</section>
</body>
</html>