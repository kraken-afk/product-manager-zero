import { getData, validate } from './func.js';

const submitBtn = document.getElementById('submitBtn');

submitBtn.addEventListener('click', (e) => {
  if (!validate(getData())) {
    e.preventDefault();
  } else {
    if (window.confirm("Are you sure want to submit this product?"))
      return;
    else
      e.preventDefault();
  }
});