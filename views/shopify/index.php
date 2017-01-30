<div class="col-md-9">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
								<ol class="breadcrumb">
                    <li><a href="<?php echo MEMBERSURL ?>">Home</a>
                    </li>
                    <li class="active">Shopify Products</li>
                </ol>
								
                <h1 class="page-header">View Shopify Products</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
          <div class="col-md-12">
          
            <table class="table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
                <th>Price</th>
                <th>SKU</th>
                <th>Image</th>
            </tr>
            <?php

            if (is_array($this->products['products']) && count($this->products['products']) > 0) {
                foreach ($this->products['products'] as $product) { ?>
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['body_html'] ?></td>
                <td><?php echo $product['product_type'] ?></td>
                <td><?php echo $product['variants'][0]['price'] ?></td>
                <td><?php echo $product['variants'][0]['sku'] ?></td>
                <td><?php echo (isset($product['images'][0]['src']) ? '<img src=' . $product['images'][0]['src'] . ' width="20" height="20" />' : '') ?></td>
                <!-- Edit / Delete Links would go here -->
            <?php
                }
            }
            ?>
            </tr>
            </table>

          </div>
        </div>
</div>