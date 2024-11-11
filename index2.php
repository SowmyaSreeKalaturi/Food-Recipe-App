
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>Recipe Guide App</title>
</head>

<body>
    <div class="container">
        <div class="search-box">
            <input type="text" id="search-input" placeholder="Type Dish Name...">
            <button id="search-button">Search</button>
        </div>
        <div id="result"></div>
         <div class="button-container" style="display: none;"> <!-- Hide initially -->
            <button id="youtube-button">Watch on YouTube</button>
            <button id="show-recipe">View Recipe</button>
         </div>
    </div>

    <script src="script.js"></script>
</body>


</html>