<div class="delete-popup">
    <span class="delete-popuptext" id="delete-popup">
        <span onclick="deleteTaskPopup()" class="material-symbols-outlined close-button">
            close
        </span>
        <span class="material-symbols-outlined delete-icon">
            cancel
            </span>
        <h1 class="delete-title">Weet je het zeker?</h1>
        <p class="delete-text">Wil je echt deze taak verwijderen?</p>
        <button class="cancel-button" onclick="deleteTaskPopup()">Annuleer</button>
        <button class="delete-button" onclick="deleteTask()">Verwijder</button
    </span>
</div>

<script>
    function deleteTaskPopup() {
        document.getElementById('delete-popup').classList.toggle('show');
    }

    function deleteTask() {
        document.getElementById('delete-form-task').submit();
    }

    document.querySelectorAll('td:last-child').forEach(td => {
        td.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>