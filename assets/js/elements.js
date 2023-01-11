const element = document.querySelector('.error-msg');

setTimeout(() => {
  element.parentNode.removeChild(element);
}, 3000);