<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Add Employees</title>
</head>
<body>
<section class="add-products">
    <form action="{{route('admins.store')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <h3>Add Employees</h3>
        <input type="text"  placeholder="enter name" name="name" maxlength="100" class="box" value="{{old('name')}}" required>
        @error('name')
        <div class="error">
                    {{$message}}
        </div>
        @enderror

        <input type="email"  placeholder="enter email " name="email" class="box" value="{{old('email')}}" required>
        @error('email')
        <div class="error">
                    {{$message}}
        </div>
        @enderror

        <input type="number"  placeholder="enter phone number" name="number" onkeypress="if(this.value.length == 10) return false;" class="box" value="{{old('price')}}" required>
        @error('number')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="text"  placeholder="enter address" name="address" maxlength="100" class="box" value="{{old('address')}}" required>
        @error('address')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
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
        <input type="file" name="img" class="box"
        accept="img/jpg, img/jpeg, img/png , img/webp" required>
        @error('img')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="password"  placeholder="enter the password" name="password" maxlength="100" class="box" value="{{old('password')}}" required>
        @error('password')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="password"  placeholder="enter the confirm password" name="password_confirmation"" maxlength="100" class="box" value="{{old('confirm_password')}}">
        @error('password_confirmation')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="submit" value="add employee" name="add_employee" class="btn">
    </form>
</section>
</body>
</html>