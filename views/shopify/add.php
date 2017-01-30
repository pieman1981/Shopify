
  <!-- Content Column -->
  <div class="col-md-9">
  
        <p class="pull-right"><a href="<?php echo MEMBERSURL ?>shopify/index" class="btn btn-warning"><span class="fa fa-arrow-left"></span> Back to all Products</a></p>
  
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
                                <ol class="breadcrumb">
                    <li><a href="<?php echo MEMBERSURL ?>">Home</a>
                    </li>
                    <li class="active">Add Product</li>
                </ol>
                                
                <h1 class="page-header">Add Shopify Product</h1>
            </div>
        </div>
        <!-- /.row -->
      
      <form method="POST" action="<?php echo MEMBERSURL ?>shopify/save">
      
      <input type="hidden" name="image" id="upLoadForm" />
      
        <div class="control-group form-group">
            <div class="controls">
                <label for="InputTitle">Title</label>
                <input class="form-control" id="InputTitle" required aria-describedby="InputTitle" placeholder="Enter Product Title" type="text" name="title">
            </div>
        </div>

        <div class="control-group form-group">
            <div class="controls">
                <label for="InputDesc">Description</label>
                <textarea class="form-control" id="InputDesc" required aria-describedby="InputDesc" placeholder="Enter Product Description" name="body_html"></textarea>
            </div>
        </div>

        <div class="control-group form-group">
            <div class="controls">
                <label for="InputType">Product Type</label>
                <select class="form-control" id="InputType" aria-describedby="InputType" name="product_type" required>
                    <option class="Running Shoe">Running Shoe</option>
                    <option class="Cross Country Shoe">Cross Country Shoe</option>
                </select>
            </div>
        </div>

        <div class="control-group form-group">
            <div class="controls">
                <label for="InputPrice">Price (£)</label>
                <input class="form-control" id="InputPrice" aria-describedby="InputPrice" required placeholder="Enter Product Price" type="number" name="price">
            </div>
        </div>

        <div class="control-group form-group">
            <div class="controls">
                <label for="InputPrice">SKU</label>
                <input class="form-control" id="InputSKU" aria-describedby="InputSKU" required placeholder="Enter Product SKU" type="text" name="sku">
            </div>
        </div>

        <div class="control-group form-group">
            <div class="controls">
                <label for="InputImage">Image</label>
                <div id="dZUpload" class="dropzone">
                      <div class="dz-default dz-message"></div>
                </div>
            </div>
        </div>

         <!-- For success/fail messages -->
        <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Add</button>
      </form>
  </div>

  

