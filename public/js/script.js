var swiper = new Swiper(".slide-container", {
  slidesPerView: 3,
  spaceBetween: 20,
  sliderPerGroup: 3,
  loop: true,
  centerSlide: "true",
  fade: "true",
  grabCursor: "true",
  pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
  },
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },

  breakpoints: {
      0: {
      slidesPerView: 1,
      },
      520: {
      slidesPerView: 2,
      },
      768: {
      slidesPerView: 3,
      },
      1000: {
      slidesPerView: 4,
      },
  },
});
        
        
        
        const darkMode = document.querySelector('.switch');
        darkMode.addEventListener('click',()=>{
        document.body.classList.toggle('dark-mode-variables');
        });
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
      <h2 class='text-center text-secondary mt-5'>Food Area: ${e.strArea}</h2>
      <h2 class='text-center text-warning'>Food Name: ${e.strMeal}</h2>
      <div class="row">
      <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
                    <input type="hidden" value="${e.strIngredient1}+${e.strIngredient2}
                    +${e.strIngredient3}+${e.strIngredient4}+
                    ${e.strIngredient5}+${e.strIngredient6}+${e.strIngredient7}
                    +${e.strIngredient8}+${e.strIngredient9}+
                    ${e.strIngredient10}" name="component">
                    <input type="hidden" value="${e.strMeal}" name="name">
                    <input type="hidden" value="${e.strArea}" name="strArea">
                    <input type="hidden" value="${e.strMealThumb}" name="image">
                    <input type="hidden" value="${sendData.meals[0].strCategory}" name="category">
      <div class="col-md-4">
          <img src="${e.strMealThumb}" alt="" class='w-100 img'>
      </div>
      <div class="col-md-4">
          <h2>Ingredients:</h2>
          <ul>
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
      <div class="col-md-4">
          <h2>Measurements:</h2>
          <ul>
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
  <div class="col-12">
      <h2>Instructions:</h2>
      <p>${e.strInstructions}</p>
  </div>
  <div class='col-6 offset-3'>
      <h2 class='text-center'>Watch Full Video On <a class='text-danger yt' data-bs-toggle="modal" data-bs-target="#exampleModal${i}"><u>Youtube</u></a></h2>

      <!-- Modal -->
<div class="modal fade" id="exampleModal${i}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">${e.strMeal}</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <iframe src="https://youtube.com/embed/${e.strYoutube.slice(-11,)}" frameborder="0" width="100%" height='300'></iframe>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      
    </div>
  </div>
</div>
</div>
<input type="number" min="0" max="9999999999" placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10)
return false;" class="box">
<input type="submit" value="order now" name="add_product" class="btn" style="background-color:red;color:yellow;border-radius:8px";border:3px solid red>
        </form>
  </div>
      `
      heading.innerHTML = ` <h1 class='text-center text-danger'>Food Category: ${sendData.meals[0].strCategory}</h1>`
      appendData.innerHTML = data
  });
}).catch((error)=>{
  document.querySelector('.find').style.display = 'none';
  document.querySelector('.notfound').innerHTML = "Meal Not Found 😥";
  document.querySelector('.try').innerHTML = "Try Something Else 😉";
})
});
document.getElementById
const reviewStars = document.querySelectorAll(".review i");
const alert = document.querySelector(".alert");

reviewStars.forEach((star,index) => {
    star.addEventListener("click",() => {
        reviewStars.forEach((el) => el.classList.remove("fas","checked"));

        for(let i=0 ; i <= index ; i++){
            reviewStars[i].classList.add("fas","checked");
        }

        const starsCount = document.querySelectorAll(".review i.checked").length;

        alert.classList.add("active");

        alert.innerHTML = `${starsCount}`;

        setTimeout(()=>{
                alert.classList.remove("active");
        },2000);
    });
});