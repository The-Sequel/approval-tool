<div class="success-popup">
    <span class="success-popuptext" id="success-popup">
        <p>{{ session('success') }}</p>
    </span>
</div>


<script>
    // Function to hide the success popup after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
    var successPopup = document.getElementById('success-popup');
    if (successPopup && successPopup.textContent.trim().length > 0) {
        successPopup.style.visibility = 'visible';
        setTimeout(function() {
            successPopup.style.visibility = 'hidden';
        }, 7000); // 5000 milliseconds = 5 seconds
    }
});

</script>