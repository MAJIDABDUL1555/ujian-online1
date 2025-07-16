    </div>
  </div>
  

    <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/46.0.0/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/46.0.0/",
                    "ckeditor5-premium-features": "https://cdn.ckeditor.com/ckeditor5-premium-features/46.0.0/ckeditor5-premium-features.js",
                    "ckeditor5-premium-features/": "https://cdn.ckeditor.com/ckeditor5-premium-features/46.0.0/"
                }
            }
        </script>
        

        <!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
          console.error(error);
      });
</script>


  <!-- plugins:js -->
  <script src="<?= $mainUrl ?>vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="<?= $mainUrl ?>js/off-canvas.js"></script>
  <script src="<?= $mainUrl ?>js/hoverable-collapse.js"></script>
  <script src="<?= $mainUrl ?>js/template.js"></script>

  <!-- data table -->
   <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

   <script>
    let table = new DataTable('#mytable');
   </script>

</body>
</html>
