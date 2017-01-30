        </div> <!-- /.row -->
      
      </div><!-- /.main-content -->
      
      <footer>
      
        <div class="row">
          <div class="col-lg-12">
            <p class="small">&copy; <?php echo date('Y'); ?></p>
          </div>
        </div>
      </footer>
    </div><!-- /.container -->
      
      <script src="<?php echo URL ?>public/js/build/production.min.js"></script>
        <?php if ( isset($this->exjs) ) {
          foreach ($this->exjs as $js ) {
            echo '<script src="' . $js . '"></script>';
          }
        } ?>
        <?php if ( isset($this->js) ) {
          foreach ($this->js as $js ) {
            echo '<script src="' . URL . 'public/js/pages/' . $js . '"></script>';
          }
        } ?>
        
        <script>
          $(function() {
            if ($("#dZUpload").length) {
                Dropzone.autoDiscover = false;
                $("#dZUpload").dropzone({
                    url: "<?php echo URL ?>members/shopify/upload",
                    addRemoveLinks: true,
                    maxFiles: 1,
                    uploadMultiple: false,
                    success: function (file, response) {
                        var imgName = response;
                        file.previewElement.classList.add("dz-success");
                        $('#upLoadForm').val(response);
                    },
                    error: function (file, response) {
                        file.previewElement.classList.add("dz-error");
                    }
                });
            }
          });
        </script>
	</body>
</html>