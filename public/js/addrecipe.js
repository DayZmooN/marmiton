// $(document).ready(function () {
//     // Recherche en temps réel des ingrédients avec AJAX
//     $('#ingredients').on('input', function () {
//         var searchTerm = $(this).val();

//         $.ajax({
//             url: '{{ path('searchIngredients') }}',
//             type: 'GET',
//             dataType: 'json',
//             data: {
//                 term: searchTerm
//             },
//             success: function (response) {
//                 var ingredientList = $('#ingredient-list');
//                 ingredientList.empty();

//                 for (var i = 0; i < response.length; i++) {
//                     ingredientList.append('<div>' + response[i] + '</div>');
//                 }
//             }
//         });
//     });

//     // Gestion de l'ajout des ingrédients sélectionnés à la liste visible
//     // ...

//     // Fonction pour ajouter un ingrédient à la liste visible
//     function addIngredientToList(ingredient) {
//         // Créer un élément de la liste avec le nom de l'ingrédient
//         var listItem = $('<li>').text(ingredient);

//         // Ajouter un bouton de suppression à l'élément de la liste
//         var deleteButton = $('<button>').text('Supprimer').click(function () {
//             listItem.remove();
//         });
//         listItem.append(deleteButton);

//         // Ajouter l'élément de la liste à la liste visible
//         $('#ingredient-list').append(listItem);
//     }

//     // Écouter l'événement de soumission du formulaire
//     $('form').submit(function (event) {
//         event.preventDefault();

//         // Récupérer les données du formulaire
//         var title = $('#title').val();
//         var instructions = $('#instructions').val();
//         var ingredients = [];

//         // Parcourir la liste des ingrédients et les ajouter à un tableau
//         $('#ingredient-list li').each(function () {
//             ingredients.push($(this).text());
//         });

//         // Créer un objet avec les données de la recette
//         var recipeData = {
//             title: title,
//             instructions: instructions,
//             ingredients: ingredients
//         };

//         // Envoyer les données de la recette au serveur
//         $.ajax({
//             url: '{{ path('submitRecipeForm') }}',
//             type: 'POST',
//             dataType: 'json',
//             data: JSON.stringify(recipeData),
//             success: function (response) {
//                 // Traiter la réponse du serveur (redirection, message de succès, etc.)
//                 // ...
//             }
//         });
//     });
// });
