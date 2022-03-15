<div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                      Add user
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
<form id="quickForm" method="POST" action="/admin/users/add" enctype="multipart/form-data">

                <div class="card-body">

                  <div class="form-group">

                    <label for="name">Full Name</label>

                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">

                  </div>

                  <div class="form-group">

                    <label for="email">Email</label>

                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">

                  </div>

                  <div class="form-group">

                    <label for="password">Password</label>

                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">

                  </div>

                  <div class="form-group">

                    <label for="confirmPassword">confirm password</label>

                    <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="confirmPassword">

                  </div>

                    <div class="form-group">

                      <label for="room">Room number</label>

                      <input type="number" name="room" class="form-control" id="room" placeholder="Enter room number">

                    </div>

                    <div class="form-group">

                        <label for="ext">Ext</label>

                        <input type="text" name="ext" class="form-control" id="ext" placeholder="Enter ext">

                      </div>

                      <div class="form-group">

                        <label for="inputFile">Profile Picture</label>

                        <div class="input-group">

                          <div class="custom-file">

                            <label class="custom-file-label" for="inputFile">Choose image</label>

                            <input class="custom-file-input" type="file" accept="image/png, image/gif, image/jpeg" id="avatar" name="avatar">

                          </div>


                        </div>

                      </div>

                </div>

                <!-- /.card-body -->

                <div class="card-footer">

                  <button type="submit" class="btn btn-primary">Submit</button>

                </div>

              </form>

                </div>
                <!-- /.card -->
              </div>