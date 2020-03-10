<!-- Modal -->
<div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="product_form" onsubmit="return false">
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Please Enter Product Name">
            <small id="prt_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Date</label>
            <input type="text" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d") ?>" readonly>
            <small id="dat_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="select_cat" name="select_cat">
                
            </select>
            <small id="cate_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <label>Brand</label>
            <select class="form-control" id="select_bar" name="select_bar">
              
            </select>
            <small id="brd_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Please Enter Product Price">
            <small id="pri_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Product Quantity</label>
            <input type="text" class="form-control" id="product_stock" name="product_stock" placeholder="Please Enter Product Quantity">
            <small id="stk_error" class="form-text text-muted"></small>
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
