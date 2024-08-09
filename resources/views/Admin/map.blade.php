<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location of restaurant</title>
</head>
<body>

    <section id="main">

    </section>

<script>
    //var liveMap;
    if(navigator.geolocation){
        navigator.geolocation.watchPosition(function(position){
            console.log(position)
            //document.getElementById("main").innerHTML = `
            //<iframe height="" src=""></iframe>`
        },
        function(error){
            console.log(error)
        })
    }
</script>
</body>
</html>



