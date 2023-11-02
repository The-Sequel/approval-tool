<div class="delete-popup-project">
    <span class="delete-popup-projecttext" id="delete-popup-project">
        <span onclick="deleteProjectPopup()" class="material-symbols-outlined close-button">
            close
        </span>
        <span class="material-symbols-outlined delete-icon">
            cancel
            </span>
        <h1 class="delete-title">Weet je het zeker?</h1>
        <p class="delete-text">Wil je echt dit project verwijderen? Hierbij verwijder je ook alle taken toegewezen aan het project.</p>
        <button class="cancel-button" onclick="deleteProjectPopup()">Annuleer</button>
        <button class="delete-button" onclick="deleteProject()">Verwijder</button
    </span>
</div>

<script>
    function deleteProjectPopup() {
        document.getElementById('delete-popup-project').classList.toggle('show');
    }

    function deleteProject() {
        document.getElementById('delete-form-project').submit();
    }

    document.querySelectorAll('td:last-child').forEach(td => {
        td.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>