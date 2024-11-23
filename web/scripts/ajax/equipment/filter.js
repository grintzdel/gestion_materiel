document.addEventListener("DOMContentLoaded", () => {
  let selectedCategories = [];
  let selectedAvailability;

  document.querySelectorAll(".filter__content").forEach((filter) => {
    filter.addEventListener("change", function () {
      // Récupérer toutes les cases cochées
      selectedCategories = Array.from(
        document.querySelectorAll(
          '.filter__list__item input[type="checkbox"]:checked'
        )
      ) // checkbox
        .map((input) => {
          // Extraire l'ID de la catégorie (en retirant "category-" du début)
          return input.id.replace("category-", "");
        });
      const availabilityRadio = document.querySelector(
        'input[name="availability"]:checked'
      );
      selectedAvailability = availabilityRadio
        ? availabilityRadio.id.replace("availability-", "")
        : null;

      // Envoyer les IDs sélectionnés via une requête AJAX
      fetch("/equipment/find", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          categories: selectedCategories,
          availability: selectedAvailability,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          updateEquipmentDisplay(data);
        })
        .catch((error) => {
          console.error("Erreur:", error);
        });
    });
  });
});

function createEquipmentCard(material) {
  // Création des éléments
  const equipment = document.createElement("div");
  equipment.className = "equipment";

  // Image container
  const imageContainer = document.createElement("div");
  imageContainer.className = "equipment__image";

  const image = document.createElement("img");
  image.src = material.image;
  image.alt = material.name;
  imageContainer.appendChild(image);

  // Content container
  const contentContainer = document.createElement("div");
  contentContainer.className = "equipment__content";

  const title = document.createElement("h2");
  title.className = "equipment__content__title";
  title.textContent = material.name;

  const button = document.createElement("a");
  button.href = "#";
  button.className = `button ${
    material.available > 0 ? "button--primary" : "button--secondary"
  }`;
  button.textContent = material.available > 0 ? "Disponible" : "Indisponible";

  // Assemblage des éléments
  contentContainer.appendChild(title);
  contentContainer.appendChild(button);

  equipment.appendChild(imageContainer);
  equipment.appendChild(contentContainer);

  return equipment;
}

function updateEquipmentDisplay(materials) {
  const collectionContainer = document.querySelector(".archive__collection");

  // Vider le conteneur
  clearElement(collectionContainer);

  // Créer et ajouter les nouvelles cartes
  const fragment = document.createDocumentFragment();
  materials.forEach((material) => {
    const card = createEquipmentCard(material);
    fragment.appendChild(card);
  });

  collectionContainer.appendChild(fragment);
}

function clearElement(element) {
  while (element.firstChild) {
    element.removeChild(element.firstChild);
  }
}
