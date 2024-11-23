document.addEventListener('DOMContentLoaded', () => {
    let selectedCategories = [];
    let selectedAvailability;

    document.querySelectorAll('.filter__content').forEach(filter => {
        filter.addEventListener('change', function () {
            // Récupérer toutes les cases cochées
            selectedCategories = Array.from(document.querySelectorAll('.filter__list__item input[type="checkbox"]:checked'))  // checkbox
                .map(input => {
                    // Extraire l'ID de la catégorie (en retirant "category-" du début)
                    return input.id.replace('category-', '');
                });
            const availabilityRadio = document.querySelector('input[name="availability"]:checked');
            selectedAvailability = availabilityRadio ? availabilityRadio.id.replace('availability-', '') : null;

            // Envoyer les IDs sélectionnés via une requête AJAX
            fetch('/equipment/find', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    categories: selectedCategories,
                    availability: selectedAvailability
                }),
            })
                .then(response => response.json())
                .then(data => {
                    generateTable(data);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        });
    });
});

function generateTable(materials) {
    // Sélectionner le conteneur du tableau
    const tableContainer = document.querySelector('.archive__collection');
    const tbody = tableContainer.querySelector('tbody');

    // Vider le conteneur avant d'ajouter un nouveau tableau
    clearElement(tbody);

    // Ajouter les lignes des données
    materials.forEach(material => {
        const tr = document.createElement('tr');

        // Créer les colonnes pour chaque champ
        const nameTd = document.createElement('td');
        nameTd.textContent = material.name;

        const descriptionTd = document.createElement('td');
        descriptionTd.textContent = material.description;

        const availableTd = document.createElement('td');
        availableTd.textContent = material.available;

        const requireKeyTd = document.createElement('td');
        requireKeyTd.textContent = material.require_key ? 'Oui' : 'Non';

        // Ajouter les colonnes à la ligne
        tr.appendChild(nameTd);
        tr.appendChild(descriptionTd);
        tr.appendChild(availableTd);
        tr.appendChild(requireKeyTd);

        // Ajouter la ligne au tableau
        tbody.appendChild(tr);
    });
}

function clearElement(element) {
    while (element.firstChild) {
        element.removeChild(element.firstChild);
    }
}
