<!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
  setTimeout(() => {
  // Step 1: Wait 2 seconds before hiding
  const msg = document.getElementById('Message');
  if (msg) {
    // Step 2: Apply a fade-out effect over 1 second
    msg.style.transition = 'opacity 1s ease';
    msg.style.opacity = '0';

    // Step 3: After fade-out completes, remove the element from DOM
    setTimeout(() => msg.remove(), 1000);
  }
}, 2000); // Initial 2-second delay before hiding
</script>
</body>

</html>