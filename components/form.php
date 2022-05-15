<form class="form" method="POST">
  <div class="input-wrapper unique-wrapper">
    <label for="name">Name</label>
    <input required type="text" id="name" name="name" class="unique">
    <small class="err-msg">*Invalid product name</small>
  </div>

  <div class="input-wrapper">
    <label for="category">Category</label>
    <select name="category" id="category">
      <option value="">-</option>
      <option value="food">Food</option>
      <option value="drink">Drink</option>
      <option value="other">Other</option>
    </select>
    <small class="err-msg">*Please pick the category</small>

  </div>

  <div class="input-wrapper">
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <small class="err-msg">*Text length can't be over 300 characters</small>

  </div>

  <div class="input-number">
    <div class="input-wrapper">
      <label for="price">Price</label>
      <input required placeholder="0" name="price" id="price" type="number"></input>
      <small class="err-msg">*Only numeric input and less then 10 digits</small>
    </div>

    <div class="input-wrapper">
      <label for="stock">Stock</label>
      <input required placeholder="0" name="stock" id="stock" type="number"></input>
      <small class="err-msg">*Only numeric input and less then 10 digits</small>
    </div>
  </div>
  <div class="btn-wrapper">
    <button name="submit" class="submit-btn" id="submitBtn" role="submit">Submit</button>
  </div>
</form>