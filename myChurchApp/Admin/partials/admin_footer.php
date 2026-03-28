</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $("#email").change(function(){
            var data = $(this).val();
            var data2send = { "email": data }; // Use object notation
            console.log("Data being sent:", data2send);

            $.get("../process/val_admin_email.php", data2send, function(rsp){
                // console.log("Response received:", rsp); // Log response

                $('#email_response').html(rsp);
                $('#email_response').addClass('text-info');

                if (rsp == "Email has been taken") {
                    $('#btn_admin').attr('disabled', 'disabled');
                } else {
                    $('#btn_admin').removeAttr('disabled');
                }
            });
        });
    });
</script>

</body>
</html>
