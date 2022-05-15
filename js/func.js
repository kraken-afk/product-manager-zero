export function getData() {
  const name = document.getElementById('name');
  const description = document.getElementById('description');
  const category = document.getElementById("category");
  const price = document.getElementById('price');
  const stock = document.getElementById('stock');

  return (
    [
      {
        target: name.id,
        value: name.value,
        status: false
      },
      {
        target: description.id,
        value: description.value,
        status: false
      },
      {
        target: category.id,
        value: category.value,
        status: false
      },
      {
        target: price.id,
        value: price.value,
        status: false
      },
      {
        target: stock.id,
        value: stock.value,
        status: false
      }
    ]
  )
}

export function validate(data) {
  const regexp = {
    name: /[A-z ]{3,64}/,
    description: /[A-z ]{0,300}/,
    priceAndStock: /[0-9]{1,10}/
  }

  data.forEach((e, i, arr) => {
    switch (e.target) {
      case "price":
      case "stock":
        if (regexp["priceAndStock"].test(parseInt(e.value))) {
          arr[i].status = true;
        }
      break;
      case "category":
        if (e.value)
          arr[i].status = true;
        break;
      default:
        if (regexp[e.target].test(e.value)) {
          return arr[i].status = true;
        }
      }
      if (!data[i].status)
        document.getElementById(e.target).parentElement.classList.add('active');
      else
        document.getElementById(e.target).parentElement.classList.remove('active');
  })
  return data.every(e => e.status);
  
}