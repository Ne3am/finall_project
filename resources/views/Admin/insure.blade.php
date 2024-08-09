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
<section class="update-product">

<h1 class="heading">Add new product</h1>

<form action="{{(route('Meals.store'))}}" method="POST" enctype="multipart/form-data">
    @csrf
                    
                    <input type="hidden" value="<?= $_GET['name']; ?>" id="title" name="name">
                    <input type="hidden" id="recipe" value="<?= $_GET['component']; ?>" name="component">
                    <input type="hidden" value="<?= $_GET['strArea']; ?>" name="strArea">
                    <input type="hidden" value="<?= $_GET['image']; ?>" name="image">
                    <img src="<?= $_GET['image']; ?>"  alt="">
                    <p><span>Name : </span><?= $_GET['name']; ?></p>
                    <p><span>Category : </span></p>
                    <select name="category" class="box" >
                            <option value="{{old('category')}}" disabled selected>select category --</option>
                            <option value="main dish">main dish</option>
                            <option value="fast food">fast food</option>
                            <option value="drinks">drinks</option>
                            <option value="desserts">desserts</option>
                    </select>
                    <p><span>Component : </span><?= $_GET['component']; ?></p>
                    <input type="number" min="0" value="" max="9999999999" placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10)
                    return false;" class="box">
                    </br></br>
                    <input type="text" onclick="Frecipe()" value="" name="calories" placeholder="calories" class="box" id="output" require>
                    </br></br>
                    <input type="text" value=""  placeholder="Gluten" name="gluten" class="box" id="Gluten" require>
                    <input type="hidden" value=""  name="Vegetarian" class="box" id="Vegetarian" require>
                    <input type="hidden" value=""   name="Kidney_friendly" class="box" id="Kidney_friendly" require>
                    <input type="hidden" value=""   name="Carbohydrate" class="box" id="Carbohydrate" require>
                    <input type="hidden" value=""   name="quantity_Carbohydrate" class="box" id="quantity_Carbohydrate" require>
    <div class="flex-btn">
        <a href="{{url('Meals')}}" class="option-btn option2">go back</a>
    </div>
    <input type="submit" value="Add Now" name="add_product" class="btn" >
</form>

</section>
                    
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

                    console.log(data);
                    
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
                        }else{
                            Carbohyd.value = "false";
                            quantityOfCarbohydrate.value = data.totalDaily.CHOCDF.quantity ;
                        }
                        
                });
            }
    </script>

    </body>
    </html>
    
                    