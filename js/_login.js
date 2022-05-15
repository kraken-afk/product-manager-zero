const submitBtn = document.getElementById('submit-btn');
const showPw = document.getElementById('show-password-btn');

submitBtn.addEventListener('click', (event) => {
  // event.preventDefault();
})

showPw.addEventListener('click', (event) => {
  if (!+event.target.dataset.show) {
    event.target.textContent = "Hide password";
    event.target.setAttribute("data-show", 1);

    event.target.previousElementSibling.setAttribute('type', 'text');
  } else {
    event.target.textContent = "Show password";
    event.target.setAttribute("data-show", 0);

    event.target.previousElementSibling.setAttribute('type', 'password');
  }
})