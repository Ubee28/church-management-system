</div>

<!-- Bootstrap JS and Popper.js (for interactive components like carousel) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS Bundle (includes Popper.js) -->
<!-- <script src="../assets/bootstrap/js/boostrap.bundle.min.js"></script> -->

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
       <script>
        $(document).ready(function(){
          $("#email").change(function(){
            var data = $(this).val();
            var data2send = {"email": data};
             // Log the data being sent
            console.log("Data being sent:", data2send);

            $.get("/churchApp/process/validate_email.php",data2send, function(rsp){
              $('#email_feedback').html(rsp);
              $('#email_feedback').addClass('text-info');
              if(rsp == "Email has been taken"){
                $('#btnregister').attr('disabled', 'disabled')
              }else{
                $('#btnregister').removeAttr('disabled')
              }
           
            }); 
          });
        });
      </script>
          <!-- Custom JQ for scroll effect -->
    <script>
      $(document).ready(function() {
          $(window).scroll(function() {
              var navbar = $('.navbar.sticky-navbar');
              if ($(window).scrollTop() > 50) {
                  navbar.addClass('scrolled');
              } else {
                  navbar.removeClass('scrolled');
              }
          });
      });

    </script>
</body>
</html>