<div class="error-popup">
    <span class="error-popuptext" id="error-popup">
        <p>{{ session('error') }}</p>
    </span>
</div>


<script>
    // Function to hide the error popup after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
    var errorPopup = document.getElementById('error-popup');
    if (errorPopup && errorPopup.textContent.trim().length > 0) {
        errorPopup.style.visibility = 'visible';
        setTimeout(function() {
            errorPopup.style.visibility = 'hidden';
        }, 5000); // 5000 milliseconds = 5 seconds
    }
});

</script>