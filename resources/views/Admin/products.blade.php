<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">

</head>
<body>
    <header>
        <nav>
        <a href="{{url('Admin-home')}}">Dashboard</a>
            <a href="{{url('products')}}">Product</a>
            <a href="{{url('Meals')}}">More</a>
            <a href="{{url('users')}}">Users</a>
            <a href="{{url('order')}}">Orders</a>
            <a href="{{url('profits')}}">Reports</a>
            <a href="{{url('sale')}}">Sale</a>
            <a href="{{url('admins')}}">Admins</a>
            <a href="{{url('messages')}}">Message</a>
            <span></span>
        </nav>
        
    </header>
    @include('Admin/light_dark')
<!-- add products section starts  -->

<section class="add-products">
    <form action="{{route('products.store')}}" id="recipe-check-form" method="POST" enctype="multipart/form-data" >
        @csrf
        <h3>add product</h3>
        <input type="text"  placeholder="enter product name" id="title" name="name" maxlength="100" class="box" value="{{old('name')}}">
        @error('name')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        
        <input type="number" min="0" max="9999999999" placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="{{old('price')}}">
        @error('price')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <select name="category" class="box" >
            <option value="{{old('category')}}" disabled selected>select category --</option>
            <option value="main dish">Main dish</option>
            <option value="fast food">Fast food</option>
            <option value="drinks">Drinks</option>
            <option value="sea food">Sea food</option>
            <option value="desserts">Desserts</option>
        </select>
        @error('category')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="file" name="image" class="box"
        accept="image/jpg, image/jpeg, image/png , image/webp" required>
        @error('image')
        <div class="error">
                    {{$message}}
        </div>
        @enderror

        <textarea required id="recipe" placeholder="enter the component" name="component" rows="4" cols="3" class="box"></textarea>
        @error('component')
        <div class="error">
                    {{$message}}
        </div>
        @enderror
        <input type="text" onclick="Frecipe()" name="calories" placeholder="calories" value="555" class="box" id="output" required>
        
        <input type="text" value=""  placeholder="Gluten" name="gluten" class="box" id="Gluten" require>
        <input type="hidden" value=""   name="Kidney_friendly" class="box" id="Kidney_friendly" require>
        <input type="hidden" value=""  name="Vegetarian" class="box" id="Vegetarian" require>
        <input type="hidden" value=""   name="Carbohydrate" class="box" id="Carbohydrate" require>
        <input type="hidden" value=""   name="quantity_Carbohydrate" class="box" id="quantity_Carbohydrate" require>    
                    
        <input type="submit" value="add product" name="add_product" class="btn">
    </form>
</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">
        @if(count($products) > 0)
    <div class="box-container">
    @foreach($products as $product)
    <div class="box">
        <img src="{{$product['image']}}" alt="">      
        <div class="component"><span>Component : </span>{{$product['component']}}</div>
        <div class="flex">
            <div class="price"><span>$</span>{{$product['price']}}</div> <span> - </span>
            <div class="category">{{$product['category']}}</div> <span> - </span>
            <div class="name">{{$product['name']}} </div>
        </div>
        <div><span>Calories</span>{{$product['calories']}}</div>
        <div class="flex-btn">
            <a href="{{route('products.edit' , ['product' => $product['id'] ] )}}"  class="option-btn">update</a>
            <form action="{{route('products.destroy' , ['product' => $product['id'] ] )}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="delete-btn" >delete</button>
            </form>
        </div>
    </div>
    @endforeach
@else
<p>There are no products to display </p>

    </div>
    @endif

</section>
<!-- show products section ends -->
<script>
            const titleInput = document.getElementById('title');
            const recipeInput = document.getElementById('recipe');
            const output = document.getElementById('output');
            const gluten = document.getElementById('Gluten');
            const Vegetable = document.getElementById('Vegetarian');
            const Kidney = document.getElementById('Kidney_friendly');
            const Carbohyd = document.getElementById('Carbohydrate');
            const quantityOfCarbohydrate = document.getElementById('quantity_Carbohydrate');
            const appId = 'c8e48860';
            const apiKey = '06f6dc290430a2f67b2cfe65fc3bbda2';

            function  fetchRecipe(){
                let title = titleInput.value;
                let ingr = recipeInput.value.split('\n');
                return fetch(`https://api.edamam.com/api/nutrition-details?app_id=${appId}&app_key=${apiKey}`,{
                    method: 'POST',
                    cache: 'no-cache',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({title,ingr})
                }).then(response => response.json());

            }
            function  Frecipe(){
                let Free_Gluten ;
                let Vegetarian ;
                let Kidney_friendly;
                let i , key ;
                fetchRecipe().then(data => {
                    let html = ` ${data.calories} `;
                        output.value = html;
                        let health_length = data.healthLabels.length ;
                        for(i=0 ; i<health_length ; i++){
                                    if(data.healthLabels[i] == "GLUTEN_FREE"){
                                        Free_Gluten = "true";
                                    }
                                    if(data.healthLabels[i] == "VEGETARIAN"){
                                        Vegetarian = "true";
                                    }
                                    if(data.healthLabels[i] == "KIDNEY_FRIENDLY"){
                                        Kidney_friendly = "true" ;
                                    }

                        }
                        if(Free_Gluten == "true"){
                            gluten.value = "true";
                        }else{
                            gluten.value = "false";
                        };
                        if(Vegetarian == "true"){
                            Vegetable.value = "true";
                        }else{
                            Vegetable.value = "false"
                        };
                        if(Kidney_friendly == "true"){
                            Kidney.value ="true";
                        }else{
                            Kidney.value = "false";
                        };
                        
                        if(data.totalDaily.CHOCDF.quantity <= 55){
                            Carbohyd.value = "true";
                            quantityOfCarbohydrate.value = data.totalDaily.CHOCDF.quantity ;
                        }
                        
                        
                        console.log(data);
                });
            }
    </script>
</body>
</html>