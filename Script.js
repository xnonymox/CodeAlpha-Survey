// Script.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("survey-form");
  const fieldsets = form.querySelectorAll("fieldset");
  const prevButton = document.getElementById("prev-button");
  const nextButton = document.getElementById("next-button");
  const submitButton = document.getElementById("submit-button");
  let currentPage = 0;

  function showPage(pageIndex) {
    fieldsets.forEach((fieldset, index) => {
      fieldset.classList.remove("active");
      if (index === pageIndex) {
        fieldset.classList.add("active");
      }
    });
  }

  function navigateToPage(pageIndex) {
    if (pageIndex >= 0 && pageIndex < fieldsets.length) {
      currentPage = pageIndex;
      showPage(currentPage);
      updateButtons();
    }
  }

  function updateButtons() {
    prevButton.disabled = currentPage === 0;
    nextButton.disabled = currentPage === fieldsets.length - 1;
    submitButton.style.display = currentPage === fieldsets.length - 1 ? "inline-block" : "none";
  }

  prevButton.addEventListener("click", () => navigateToPage(currentPage - 1));
  nextButton.addEventListener("click", () => navigateToPage(currentPage + 1));

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    
    alert("Form submitted successfully!"); 
  });

  showPage(currentPage);
  updateButtons();
});
