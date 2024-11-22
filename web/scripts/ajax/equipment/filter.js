document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.filter__content').addEventListener('change', function () {
        // Récupérer toutes les cases cochées
        const selectedCategories = Array.from(document.querySelectorAll('.filter__list__item input:checked'))
            .map(input => {
                // Extraire l'ID de la catégorie (en retirant "category-" du début)
                return input.id.replace('category-', '');
            });

        // Envoyer les IDs sélectionnés via une requête AJAX
        fetch('/equipment/find', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ categories: selectedCategories }),
        })
            .then(response => response.json())
            .then(data => {
                console.log('Résultats:', data);
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    });
});
