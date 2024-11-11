const resultContainer = document.getElementById("result");
const searchBtn = document.getElementById("search-button");
const searchInput = document.getElementById("search-input");
const searchContainer = document.querySelector(".search-box");

// API URL to fetch meal data
const apiUrl = "https://www.themealdb.com/api/json/v1/1/search.php?s=";

// Event listeners for search and input (when pressing enter)
searchBtn.addEventListener("click", searchMeal);
searchInput.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        searchMeal();
    }
});

// Handle meal function
function searchMeal() {
    const userInput = searchInput.value.trim();
    if (!userInput) {
        resultContainer.innerHTML = `<h3>Input Field Cannot Be Empty</h3>`;
        return;
    }
    // Fetch meal data using API with user input
    fetch(apiUrl + userInput)
        .then((response) => response.json())
        .then((data) => {
            const meal = data.meals ? data.meals[0] : null;
            // Handle case where no meal is found
            if (!meal) {
                resultContainer.innerHTML = `<h3>No Meal Found, Please Try Again!</h3>`;
                return;
            }
            displayRecipe(meal);
        })
        // Handle error
        .catch(() => {
            searchContainer.style.opacity = '1';
            searchContainer.style.display = 'grid';
            resultContainer.innerHTML = `<h3 style="color: red;">Error fetching data!</h3>`;
        });
}

// Generate HTML for list of ingredients
function getIngredients(meal) {
    let ingreHtml = "";
    // There can be a maximum of 20 ingredients
    for (let i = 1; i <= 20; i++) {
        const ingredient = meal[`strIngredient${i}`];
        if (ingredient) {
            const measure = meal[`strMeasure${i}`];
            ingreHtml += `<li>${measure} ${ingredient}</li>`;
        }
        // If ingredient doesn't exist, exit loop
        else {
            break;
        }
    }
    return ingreHtml;
}

// Display recipe details
function displayRecipe(meal) {
    const ingredients = getIngredients(meal);
    const recipeHtml = `
        <div class="details">
            <h2>${meal.strMeal}</h2>
            <h4>${meal.strArea}</h4>
        </div>
        <img src="${meal.strMealThumb}" alt="${meal.strMeal}" />
        <div id="ingre-container">
            <h3>Ingredients:</h3>
            <ul>${ingredients}</ul>
        </div>
        <div class="button-container">
            <button id="youtube-button">Watch on YouTube</button>
            <button id="show-recipe">View Recipe</button>
        </div>
        <div id="recipe" style="display: none;">
            <button id="hide-recipe">X</button>
            <pre id="instructions">${meal.strInstructions}</pre>
        </div>
    `;

    resultContainer.innerHTML = recipeHtml;

    // Event listeners for buttons
    document.getElementById("hide-recipe").addEventListener("click", hideRecipe);
    document.getElementById("show-recipe").addEventListener("click", showRecipe);
    document.getElementById("youtube-button").onclick = function() {
        const youtubeSearchUrl = `https://www.youtube.com/results?search_query=${encodeURIComponent(meal.strMeal)}+recipe`;
        window.open(youtubeSearchUrl, '_blank');
    };


    searchContainer.style.opacity = '0';
    searchContainer.style.display = 'none';
}

// Handle show and hide recipe for a meal
function hideRecipe() {
    const recipe = document.getElementById("recipe");
    recipe.style.display = "none";
}
function showRecipe() {
    const recipe = document.getElementById("recipe");
    recipe.style.display = "block";
}


