// Script.js

// Function to update character count for a field
function updateLength(fieldId, maxLength, maxDigits = 0) {
    const field = document.getElementById(fieldId);
    const lengthDisplay = document.getElementById(`${fieldId}-length`);

    const fieldValue = field.value;
    const fieldLength = fieldValue.length;
    const displayText = maxDigits ? `${fieldLength} / ${maxDigits} digits` : `${fieldLength} / ${maxLength} characters`;
    lengthDisplay.textContent = displayText;

    if (fieldLength > (maxDigits ? maxDigits : maxLength)) {
        lengthDisplay.style.color = "red";
    } else {
        lengthDisplay.style.color = "black";
    }
}

// Attach event listeners to update character count in real-time for all fields
const fields = [
    { id: "name", maxLength: 40 },
    { id: "email", maxLength: 200 },
    { id: "mobile", maxLength: 10, maxDigits: 10 },
    { id: "college", maxLength: 200 },
    { id: "education", maxLength: 200 },
    { id: "branch", maxLength: 200 },
    { id: "alternate-contact", maxLength: 10, maxDigits: 10 },
    { id: "interest", maxLength: 200 }
];

fields.forEach(field => {
    const { id, maxLength, maxDigits } = field;
    const inputField = document.getElementById(id);
    inputField.addEventListener("input", () => updateLength(id, maxLength, maxDigits));
    updateLength(id, maxLength, maxDigits);
});
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
