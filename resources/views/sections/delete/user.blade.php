<div class="delete-popup">
    <span class="delete-popuptext" id="delete-popup">
        <span onclick="deleteUserPopup()" class="material-symbols-outlined close-button">
            close
        </span>
        <span class="material-symbols-outlined delete-icon">
            cancel
            </span>
        <h1 class="delete-title">Weet je het zeker?</h1>
        <p class="delete-text">Wil je echt deze gebruiker verwijderen?</p>
        <button class="cancel-button" onclick="deleteUserPopup()">Annuleer</button>
        <button class="delete-button" onclick="deleteUser()">Verwijder</button>
    </span>
</div>

<script>
    function deleteUserPopup() {
        document.getElementById('delete-popup').classList.toggle('show');
    }

    function deleteUser() {
        document.getElementById('delete-form-user').submit();
    }

    document.querySelectorAll('td:last-child').forEach(td => {
        td.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>
