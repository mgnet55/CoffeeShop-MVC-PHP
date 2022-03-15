
<form method="post" action="sign.php" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name="name">
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">

          </div>
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
          </div>
        </div>  
          <div class="form-group col-md-6">
            <label for="confirm">Confirm Password</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="confirm">
          </div>
          <div class="form-group col-md-4">
            <label for="Room">Room no.</label>
            <input type="text"class="form-control" id="inputRoom" placeholder="Room" name="Room">
          </div>
          <div class="form-group col-md-4">
             <label for="ext">Ext</label>
             <input type="text" class="form-control" id="" name="ext">
          </div>
          <div class="form-group col-md-2">
            <label for="photo">Profile picture</label>
            <input type="file" class="form-control" id="" name="photo">
          </div>
          <div class="form-group col-md-4">
            <label for="isAdmin">Admin</label>
            <select id="isAdmin" class="form-control" name="isAdmin">
              <option value ="true">True</option>
              <option value ="false">"false</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary m-2" name="sign">Sign in</button>
</form>