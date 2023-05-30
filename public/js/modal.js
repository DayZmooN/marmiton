// // Ouvrir la modal au clic sur le bouton
// document.getElementById('openModalBtn').addEventListener('click', function () {
//     document.getElementById('ingredientModal').style.display = 'block';
// });

// // Fermer la modal au clic sur la croix
// document.getElementsByClassName('close')[0].addEventListener('click', function () {
//     document.getElementById('ingredientModal').style.display = 'none';
// });

// // Filtrer les ingrédients en fonction de la recherche
// document.getElementById('searchInput').addEventListener('input', function () {
//     var filter = this.value.toUpperCase();
//     var listItems = document.getElementById('ingredientList').getElementsByTagName('li');
//     for (var i = 0; i < listItems.length; i++) {
//         var itemName = listItems[i].textContent || listItems[i].innerText;
//         if (itemName.toUpperCase().indexOf(filter) > -1) {
//             listItems[i].style.display = '';
//         } else {
//             listItems[i].style.display = 'none';
//         }
//     }
// });

// // Ajouter un ingrédient sélectionné à votre logique de gestion des ingrédients
// document.getElementById('ingredientList').addEventListener('click', function (event) {
//     if (event.target.tagName === 'SPAN') {
//         var ingredientName = event.target.textContent || event.target.innerText;
//         // Ajoutez ici votre logique pour traiter l'ingrédient sélectionné
//         console.log('Ingrédient sélectionné : ' + ingredientName);
//         // Fermez la modal après avoir traité l'ingrédient
//         document.getElementById('ingredientModal').style.display = 'none';
//     }
// });

// var selectedIngredients = [];

// document.getElementById('ingredientList').addEventListener('click', function (event) {
//     if (event.target.tagName === 'SPAN') {
//         var ingredientName = event.target.textContent || event.target.innerText;
//         var index = selectedIngredients.indexOf(ingredientName);
//         if (index > -1) {
//             // L'ingrédient est déjà sélectionné, le supprimer de la sélection
//             selectedIngredients.splice(index, 1);
//             event.target.classList.remove('selected');
//         } else {
//             // Ajouter l'ingrédient à la sélection
//             selectedIngredients.push(ingredientName);
//             event.target.classList.add('selected');
//         }
//     }
// });

// function sendRecipe() {
//     // Vérifiez si au moins un ingrédient est sélectionné
//     if (selectedIngredients.length === 0) {
//         alert('Sélectionnez au moins un ingrédient.');
//         return;
//     }

//     // Créez une requête AJAX pour envoyer les ingrédients sélectionnés à la base de données
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'url_de_votre_script_php_pour_enregistrer_la_recette', true);
//     xhr.setRequestHeader('Content-Type', 'application/json');

//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 // La recette a été enregistrée avec succès
//                 alert('La recette a été enregistrée avec succès.');
//                 // Réinitialisez les ingrédients sélectionnés
//                 selectedIngredients = [];
//                 // Fermez la modal
//                 document.getElementById('ingredientModal').style.display = 'none';
//             } else {
//                 // Une erreur s'est produite lors de l'enregistrement de la recette
//                 alert('Une erreur s\'est produite lors de l\'enregistrement de la recette.');
//             }
//         }
//     };

//     // Envoyez les ingrédients sélectionnés en tant que données JSON
//     var data = JSON.stringify({ ingredients: selectedIngredients });
//     xhr.send(data);
// }


// document.getElementsByClassName('close')[0].addEventListener('click', sendRecipe);

// document.getElementById('validateBtn').addEventListener('click', sendRecipe);




// Ouvrir la modal au clic sur le bouton
document.getElementById('openModalBtn').addEventListener('click', function () {
    document.getElementById('ingredientModal').style.display = 'block';
});

// Fermer la modal au clic sur la croix
document.getElementsByClassName('close')[0].addEventListener('click', function () {
    document.getElementById('ingredientModal').style.display = 'none';
});

// Filtrer les ingrédients en fonction de la recherche
document.getElementById('searchInput').addEventListener('input', function () {
    var filter = this.value.toUpperCase();
    var listItems = document.getElementById('ingredientList').getElementsByTagName('li');

    // Parcourir les éléments de la liste des ingrédients
    for (var i = 0; i < listItems.length; i++) {
        var ingredient = listItems[i].getElementsByTagName('span')[0];
        var ingredientName = ingredient.textContent || ingredient.innerText;

        // Vérifier si le nom de l'ingrédient correspond au filtre de recherche
        if (ingredientName.toUpperCase().indexOf(filter) > -1) {
            listItems[i].style.display = '';
        } else {
            listItems[i].style.display = 'none';
        }
    }
});
