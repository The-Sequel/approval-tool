function createCustomer(){
    var createCustomer = document.getElementById('create-customer');
    if (createCustomer.style.display === 'block') {
        createCustomer.style.display = 'none';
    } else {
        createCustomer.style.display = 'block';
    }
}

function createCustomerCard(){
    var createCustomerCard = document.getElementById('create-customer-card');
    if (createCustomerCard.style.display === 'block') {
        createCustomerCard.style.display = 'none';
    } else {
        createCustomerCard.style.display = 'block';
    }
}