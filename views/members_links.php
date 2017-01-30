
<a class="list-group-item home" href="<?php echo MEMBERSURL ?>"><i class="fa fa-home"></i> Members Home</a>
<a class="list-group-item <?php echo (isset($this->url) && $this->url == 'shopify/index' ? 'active' : '') ?>" href="<?php echo MEMBERSURL ?>shopify/index/"><i class="fa fa-eye"></i> All Products</a>
<a class="list-group-item <?php echo (isset($this->url) && $this->url == 'shopify/add' ? 'active' : '') ?>" href="<?php echo MEMBERSURL ?>shopify/add/"><i class="fa fa-plus"></i> Add Product</a>
<a class="list-group-item home" href="<?php echo MEMBERSURL ?>logout"><i class="fa fa-sign-out"></i> Logout</a>