 <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                      Add product
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Product</label>
                        <input
                          type="text"
                          name="prd_name"
                          class="form-control"
                          id="name"
                          placeholder="Enter your name"
                        />
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input
                          type="number"
                          step="0.01"
                          name="price"
                          class="form-control"
                          id="price"
                          placeholder="Enter price"
                        />
                      </div>
                      <!-- select -->
                      <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" name="cat_id">
                          <option value="1">Hot Drinks</option>
                          <option value="2">Soft Drinks</option>
                          <option value="3">Ice Craem</option>
                          <option value="4">Zbady khalat</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="inputFile">Product Picture</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input"
                              id="InputFile"
                            />
                            <label
                              class="custom-file-label"
                              for="inputFile"
                              name="image"
                              >Choose image</label
                            >
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                      <button type="reset" class="btn btn-default float-right">Cancel</button>
                    </div>
                  </form>
                </div>