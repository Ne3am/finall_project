<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/meal.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('css/stylesh.css')}}">
    <title>Meal API</title>
    
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
    <div class="container-search">
    <i class="fa-solid fa-xmark"></i>
        <input type="text" name="" id="userInput" class="search_input" placeholder="Search Your Meal...">
        <button id="btn" class="search">Search</button>
    </div>
    <section class="show-products" style="padding-top: 0;">
    <div id="heading"></div>
    <div class="box-container"  id="appendData">
        <h1 class="text-center find">Find Your Meal Now...</h1>

        <h2 class="text-center text-danger my-3 notfound"></h2>
        <h2 class="text-center text-success my-5 try"></h2>
    </div>
    </section>
    <div class="container">
        <div class="center">
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#btn').click(function(){
                $('.wave').css('display','block')
                $('.center').fadeToggle(2000);
            })
        })
    </script>

    <script>
        document.getElementById('userInput').addEventListener('focus',()=>{
    document.querySelector('i.fa-solid').style.display = "block"
})
document.getElementById('userInput').addEventListener('blur',()=>{
    document.querySelector('i.fa-solid').style.display = "none"
    if(userInput.value !== ''){
    document.querySelector('i.fa-solid').style.display = "block"
    }
})

document.querySelector('.fa-solid').addEventListener('click',()=>{
    if(userInput.value !==''){
        userInput.value = ''
    }
})

document.getElementById("btn").addEventListener("click", () => {


let user = document.getElementById("userInput").value;

let mealAPI = fetch(
`https://www.themealdb.com/api/json/v1/1/search.php?s=${user}`
);

mealAPI.then((getData)=>{
return getData.json();
}).then((sendData)=>{
console.log(sendData)
let data =''
sendData.meals.forEach((e, i) => {

    data +=`
    <div class="box">
    <h2>Food Area: ${e.strArea}</h2>
    <h2>Food Name: ${e.strMeal}</h2>
    <div>
                    <div>
        <img src="${e.strMealThumb}" alt="">
    </div>
    <div class="container-ingredients">
    <div>
        <h2>Ingredients:</h2>
        <ul class="ingredients">
                <li>${e.strIngredient1}</li>
                <li>${e.strIngredient2}</li>
                <li>${e.strIngredient3}</li>
                <li>${e.strIngredient4}</li>
                <li>${e.strIngredient5}</li>
                <li>${e.strIngredient6}</li>
                <li>${e.strIngredient7}</li>
                <li>${e.strIngredient8}</li>
                <li>${e.strIngredient9}</li>
                <li>${e.strIngredient10}</li>
                <li>${e.strIngredient11}</li>
                <li>${e.strIngredient12}</li>
                <li>${e.strIngredient13}</li>
                <li>${e.strIngredient14}</li>
                <li>${e.strIngredient15}</li>
                <li>${e.strIngredient16}</li>
                <li>${e.strIngredient17}</li>
                <li>${e.strIngredient18}</li>
                <li>${e.strIngredient19}</li>
                <li>${e.strIngredient20}</li>
            
        </ul>
    </div>
    <div>
        <h2>Measurements:</h2>
        <ul class="ingredients">
        <li>${e.strMeasure1}</li>
        <li>${e.strMeasure2}</li>
        <li>${e.strMeasure3}</li>
        <li>${e.strMeasure4}</li>
        <li>${e.strMeasure5}</li>
        <li>${e.strMeasure6}</li>
        <li>${e.strMeasure7}</li>
        <li>${e.strMeasure8}</li>
        <li>${e.strMeasure9}</li>
        <li>${e.strMeasure10}</li>
        <li>${e.strMeasure11}</li>
        <li>${e.strMeasure12}</li>
        <li>${e.strMeasure13}</li>
        <li>${e.strMeasure14}</li>
        <li>${e.strMeasure15}</li>
        <li>${e.strMeasure16}</li>
        <li>${e.strMeasure17}</li>
        <li>${e.strMeasure18}</li>
        <li>${e.strMeasure19}</li>
        <li>${e.strMeasure20}</li>
        
    </ul>
    </div>
    </div>
</div>
<div>
    <h2>Instructions:</h2>
    <p>${e.strInstructions}</p>
</div>
<form action="{{url('insure_meal')}}" method="GET" enctype="multipart/form-data">
        @csrf
                    <input type="hidden" value="${e.strMeasure1} of ${e.strIngredient1} and ${e.strMeasure2} of ${e.strIngredient2} and ${e.strMeasure3} of ${e.strIngredient3} and ${e.strMeasure4} of ${e.strIngredient4}
                    and ${e.strMeasure5} of ${e.strIngredient5} and ${e.strMeasure6} of ${e.strIngredient6} and ${e.strMeasure7} of ${e.strIngredient7} and ${e.strMeasure8} of ${e.strIngredient8} and ${e.strMeasure9} of ${e.strIngredient9} and ${e.strMeasure10} of ${e.strIngredient10}" name="component" id="recipe">
                    <input type="hidden" value="${e.strMeal}" id="title" name="name">
                    <input type="hidden" value="${e.strArea}" name="strArea">
                    <input type="hidden" value="${e.strMealThumb}" name="image">
                    <input type="hidden" value="${sendData.meals[0].strCategory}" name="category">
                    <input type="submit" value="Add Now" name="add_product" class="btn">
                    </form>
    </div></div>
        `
    heading.innerHTML = ` <h1 class='heading'>Food Category: ${sendData.meals[0].strCategory}</h1>`
        appendData.innerHTML = data
    });
}).catch((error)=>{
    document.querySelector('.find').style.display = 'none';
    document.querySelector('.notfound').innerHTML = "Meal Not Found 😥";
    document.querySelector('.try').innerHTML = "Try Something Else 😉";
})
});
    </script>
</body>
</html>