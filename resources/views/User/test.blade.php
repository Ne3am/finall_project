<?php 
    use App\Events\TrackingDelivery;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p onclick = "onLoadForm()">hello my friend </p>
<form action="" method="" id="myForm"   >
	@csrf
    <input type="text" id="lat" name="lat" value="7"  >
    <input type="text" id="lang" name="lang" value="999">
    <input type="submit" value="press">
</form>
<script>
            
        function onLoadForm() {
            var xhr = new XMLHttpRequest();
            var myform = document.getElementById("myForm");
            xhr.open("POST" , "{{url('/ajax')}}" , true );
            xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
            var formData = new FormData(myform);
            xhr.send(formData);
        }
        </script>

</body>
</html>