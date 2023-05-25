var currentStep = 1;


function showStep(step) {
    document.getElementById('step-' + step).classList.add('active');
}

function hideStep(step) {
    document.getElementById('step-' + step).classList.remove('active');
}

function nextStep(next) {
    hideStep(currentStep);
    showStep(next);
    currentStep = next;
}

function prevStep(prev) {
    hideStep(currentStep);
    showStep(prev);
    currentStep = prev;
}

function validateForm() {
    // Ajoutez ici votre logique de validation du formulaire complet
    // Par exemple, vous pouvez vérifier les champs requis

    // Une fois que le formulaire est validé, vous pouvez soumettre les données via AJAX ou rediriger l'utilisateur vers une autre page.
    alert('Formulaire soumis avec succès !');
}

showStep(currentStep);