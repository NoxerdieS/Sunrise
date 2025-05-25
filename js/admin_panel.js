const addProductBtn = document.querySelector('.admin__add--addBtn');
const popupCloseBtn = document.querySelector('.admin__contentContainer--closeBtn');
const popupShadow = document.querySelector('.admin__popup--shadow');
const popup = document.querySelector('.admin__popup');
const searchBtn = document.querySelector('#searchBtn');
const searchRes = document.querySelectorAll('.admin__product--name');
const adminProducts = document.querySelector('.admin__products') || document.querySelector('.admin__categories');
const addForm = document.querySelector("#create-product-form");

// WYSZUKIWANIE
if (searchBtn && adminProducts) {
  searchBtn.addEventListener('click', () => {
    const searchBar = document.querySelector('#searchBar');
    adminProducts.innerHTML = '';

    searchRes.forEach(element => {
      if (element.innerHTML.toLowerCase().includes(searchBar.value.toLowerCase())) {
        adminProducts.appendChild(element.parentElement);
      }
    });

    const searchResetBtn = document.createElement('i');
    searchResetBtn.classList.add('fa-solid', 'fa-x');
    searchResetBtn.setAttribute('id', 'resetSearchBtn');
    searchBtn.replaceWith(searchResetBtn);

    searchResetBtn.addEventListener('click', () => {
      searchBar.value = "";
      adminProducts.innerHTML = "";
      searchRes.forEach(element => {
        adminProducts.appendChild(element.parentElement);
      });
      searchResetBtn.replaceWith(searchBtn);
    });
  });
}

// POPUP OTWARCIE/ZAMKNIĘCIE
if (addProductBtn && popup && popupShadow) {
  addProductBtn.addEventListener('click', () => {
    popup.classList.add('visible');
    popupShadow.classList.add('visible');
  });
}

if (popupCloseBtn && popup && popupShadow) {
  popupCloseBtn.addEventListener('click', () => {
    popup.classList.remove('visible');
    popupShadow.classList.remove('visible');
  });
}

// FORMULARZ DODAWANIA
if (addForm) {
  addForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(addForm);
    const filename = formData.get("filename");
    const name = document.querySelector("#name")?.value.trim() || "";

    const errors = [];

    if (name === "") {
      errors.push("Nazwa jest wymagana.");
    }

    if (filename === "index") {
      const price = document.querySelector("#price")?.value.trim();
      const description = document.querySelector("#description")?.value.trim();
      const quantity = document.querySelector("#quantity")?.value.trim();
      const image = document.querySelector("#image")?.files[0];

      if (price === "" || isNaN(price) || parseFloat(price) <= 0) {
        errors.push("Podaj poprawną cenę.");
      }

      if (description === "") {
        errors.push("Opis produktu jest wymagany.");
      }

      if (quantity === "" || isNaN(quantity) || parseInt(quantity) < 0) {
        errors.push("Podaj poprawną ilość.");
      }

      if (!image) {
        errors.push("Zdjęcie produktu jest wymagane (.png).");
      } else if (!image.name.endsWith(".png")) {
        errors.push("Obsługiwany jest tylko format .png.");
      }
    }

    if (errors.length > 0) {
      alert(errors.join("\n"));
      return;
    }

    fetch(`../../php/admin_panel/add_item.php`, {
      method: 'POST',
      body: formData
    })
    .then(() => {
      window.location.reload();
    })
    .catch(err => {
      alert("Wystąpił błąd podczas dodawania.");
      console.error(err);
    });
  });
}
