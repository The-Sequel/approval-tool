let showFiltersButton = document.querySelector('#showFilters');

showFiltersButton.addEventListener('click', showFilters);

function showFilters(){
    if(document.querySelector('.search-form').style.display == 'block'){
        document.querySelector('.search-form').style.display = 'none';
        document.querySelector('.search-reset').style.display = 'none';

        document.querySelector('.filter-button').innerHTML = 'Toon filters';
        return;
    } else {
        document.querySelector('.search-form').style.display = 'block';
        document.querySelector('.search-reset').style.display = 'block';

        document.querySelector('.filter-button').innerHTML = 'Verberg filters';
    }
}