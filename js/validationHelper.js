// checks if element has value or not
function checkEmpty(element, errorMessage) {
  if (element.value.trim() === "") {
    const errorSpan = element.closest(".form-group").querySelector(".error-section");
    errorSpan.textContent = errorMessage;
    return false;
  }
  return true;
}

// checks value provided with pattern param
function checkPattern(element, pattern, errorMessage) {
    if (!pattern.test(element.value.trim())) {
    const errorSpan = element.closest(".form-group").querySelector(".error-section");
    errorSpan.textContent = errorMessage;
    return false;
  }
  
  return true;
}

// checks length of the value inputed
function checkLength(element, minLength, errorMessage) {
  if (element.value.length < minLength) {
    const errorSpan = element.closest(".form-group").querySelector(".error-section");
    errorSpan.textContent = errorMessage;
    return false;
  }
  return true;
}

export { checkEmpty, checkPattern, checkLength };