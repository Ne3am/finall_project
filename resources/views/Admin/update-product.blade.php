<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Update product</title>
</head>
<body>
<section class="update-product">

<h1 class="heading">update product</h1>

<form action="{{route('products.update',['product' => $product['id'] ])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put') 
    <img src="{{$product->image}}" name="img" alt="">
    <span>update name</span>
    <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="{{$product->name}}"value="{{old('name')}}">
    <span>update price</span>
    <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="{{$product->price}}">
    <span>update category</span>
    <select name="category" class="box" required>
        <option selected value="main dish">{{$product->category}}</option>
        <option value="main dish">main dish</option>
        <option value="fast food">fast food</option>
        <option value="drinks">drinks</option>
        <option value="desserts">desserts</option>
    </select>
    <span>update component</span>
    <textarea required
    placeholder="enter the component" name="component"
    class="box" rows="5" cols="4">{{$product->component}}</textarea>
    <div class="flex-btn">
        <a href="{{route('products.index')}}" class="option-btn option2">go back</a>
    </div>
    <input type="submit" value="update" class="btn" name="update">
</form>

</section>
</body>
</html>