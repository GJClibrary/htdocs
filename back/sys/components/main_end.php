<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }

  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }

  // For Demo Purpose [Changing input group text on focus]
  $(function () {
    $('input, select').on('focus', function () {
      $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
    });
    $('input, select').on('blur', function () {
      $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
    });
  });
</script>

<!-- JavaScript for form validation -->
<script>
    // JavaScript to validate form submission
    (function() {
        'use strict';
        
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');

            var validateForm = function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            };

            Array.prototype.filter.call(forms, validateForm);
        }, false);
    })();
    
    // JavaScript to validate password match
    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('passwordConfirmation');
        var errorFeedback = document.querySelector('.invalid-feedback');

        confirmPasswordInput.addEventListener('input', function() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Passwords do not match');
                errorFeedback.style.display = 'block';
            } else {
                confirmPasswordInput.setCustomValidity('');
                errorFeedback.style.display = 'none';
            }
        });

        var form = document.getElementById('registrationForm');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>

<script>
  document.querySelectorAll('.dropdown-toggle').forEach(item => {
  item.addEventListener('click', event => {
 
    if(event.target.classList.contains('dropdown-toggle') ){
      event.target.classList.toggle('toggle-change');
    }
    else if(event.target.parentElement.classList.contains('dropdown-toggle')){
      event.target.parentElement.classList.toggle('toggle-change');
    }
  })
});
</script>

</body>
</html> 