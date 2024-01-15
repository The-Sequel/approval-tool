<div class="delete-popup">
    <span class="delete-popuptext" id="delete-popup">
        <span onclick="deleteCustomerPopup()" class="material-symbols-outlined close-button">
            close
        </span>
        <span class="material-symbols-outlined delete-icon">
            cancel
            </span>
        <h1 class="delete-title">Weet je het zeker?</h1>
        <p class="delete-text">Wil je echt deze klant verwijderen?</p>
        <button class="cancel-button" onclick="deleteCustomerPopup()">Annuleer</button>
        <button class="delete-button" onclick="deleteCustomer()">Verwijder</button>
    </span>
</div>

<script>
    let currentCustomerId = null;

    function deleteCustomerPopup(id) {
        currentCustomerId = id;
        document.getElementById('delete-popup').classList.toggle('show');
    }

    function deleteCustomer() {
        document.getElementById('delete-form-customer-' + currentCustomerId).submit();

        console.log('delete customer: ' + currentCustomerId);
    }

    document.querySelectorAll('td:last-child').forEach(td => {
        td.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>
