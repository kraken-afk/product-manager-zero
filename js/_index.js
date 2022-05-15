const editModal = document.getElementById("edit-modal");

createButton().addEventListener("click", (e) => {
  e.preventDefault();
  editModal.classList.replace("enable", "disable");
})

document.addEventListener("click", (e) => {
  if (e.target.id === "edit-btn") {
    putData(getRowData(e.target));
    editModal.classList.replace("disable", "enable");
  } else if
  (e.target.id === "delete-btn") {
    if (window.confirm(`Are you sure want to delete this row ?`)) {
      const rowName = e.target.parentElement.parentElement
      .querySelector("td:nth-child(2)").textContent;
      const host = document.location.origin;
      const path = document.location.pathname;
      
      document.location.href = `${host}${path}?truncate=${rowName}`;
    } else
      return;
  }
})

editModal.addEventListener("click", (e) => {
  if (e.target.id !== editModal.id) return;
  editModal.classList.replace("enable", "disable");
})


function createButton() {
  const btnWrapper = document.querySelector('.btn-wrapper');
  const btn = document.createElement('button');

  btn.textContent = "Cancel";
  btn.setAttribute("class", "cancel-btn");
  btn.setAttribute("id", "cancel-btn");
  btn.setAttribute("role", "button");
  btnWrapper.appendChild(btn);

  return btn;
}

function getRowData(element) {
  const data = Array();
  const row = element.parentElement.parentElement
  .querySelectorAll("td:not(td:first-child):not(td:last-child)");
  
  for (let i = 0; i < row.length; i++) {
    data.push(row[i].textContent);
  }

  return data;
}

function putData(data) {
   document.getElementById('name').value = data[0]
   document.getElementById("category").value = data[1]
   document.getElementById('description').value = data[2]
   document.getElementById('price').value = data[3]
   document.getElementById('stock').value = data[4]
}