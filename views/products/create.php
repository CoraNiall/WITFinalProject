<p>Fill in the following form to create a new product:</p>
<form action="" method="POST" class="w3-container" enctype="multipart/form-data">
    
    <h2>Add New Item</h2>
</div>
    <p>
        <input class="w3-input" type="text" name="name" required autofocus>
        <label>Name</label>
    </p>
        <p>
        <input class="w3-input" type="text" name="price" required>
        <label>Price</label>
    </p>
            
  <input type="hidden" 
	   name="MAX_FILE_SIZE" 
         value="10000000"
         />

  <input type="file" name="myUploader" class="w3-btn w3-pink" required />
  <p>
    <input class="w3-btn w3-pink" type="submit" value="Add Product">
  </p>
</form>