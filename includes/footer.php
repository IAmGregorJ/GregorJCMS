<footer>
  I Am Gregor J. &copy; 2020. All rights reserved.
  <br />
  This work is licensed under a 
  <a rel="license noopener noreferrer" href="http://creativecommons.org/licenses/by-sa/4.0/" target="_blank" rel="noopener noreferrer">
    Creative Commons Attribution-ShareAlike 4.0 International License
  </a>.
  <br/>Icons made by <a href="https://www.flaticon.com/authors/freepik" target="_blank" rel="noopener noreferrer">Freepik</a> from <a href="https://www.flaticon.com/packs/hand-drawn/8" target="_blank" rel="noopener norefferer">www.flaticon.com</a>
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