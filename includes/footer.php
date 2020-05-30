<footer>
  I Am Gregor J. &copy; 2020. All rights reserved.
  <a rel="license noopener noreferrer" href="http://creativecommons.org/licenses/by-sa/4.0/" target="_blank">
      <img alt="Creative Commons License" style="border-width:0" 
        src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" />
  </a>
  <br />
  This work is licensed under a 
  <a rel="license noopener noreferrer" href="http://creativecommons.org/licenses/by-sa/4.0/" target="_blank">
    Creative Commons Attribution-ShareAlike 4.0 International License
  </a>.
</footer>
    <!-- TinyMce -->
    <script src="https://cdn.tiny.cloud/1/hgy0z2f1b4dilmwu2eyggbuw0lh7bd85c0ejtag2m759bvca/tinymce/5/tinymce.min.js" 
      referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
      tinymce.init({
        selector: '#content',
        plugins: 'autosave link image code lists',
        images_upload_base_path: '/images',
        menubar: 'edit insert view',
        toolbar: 'restoredraft | styleselect | bold italic code | blockquote | numlist bullist |  link image'
      });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/scripts/likes.js"></script>
</body>
</html>
<?php
$connection->close();
?>