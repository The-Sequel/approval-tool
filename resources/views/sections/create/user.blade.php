<div class="user-popup" id="customer-popup">
    <div class="text-container">
        <span onclick="closeCustomerPopup();" class="material-symbols-outlined close-button">
            close
        </span>

        <div id="title">
            <h2>Maak nieuwe klant</h2>
        </div>
              
    </div>
</div>
{{-- Script --}}

<script>
    function closeCustomerPopup(){
        document.querySelector('.customer-popup .text-container').style.visibility = 'hidden';
    }

    function openCustomerPopup(){
        document.querySelector('.customer-popup .text-container').style.visibility = 'visible';
    }
</script>