						</div><!-- /.md-9 -->
				</div><!-- /.row -->
			
			</div><!-- /.main-content -->

      <?php include('footer_section.php') ?>
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
	</body>
</html>