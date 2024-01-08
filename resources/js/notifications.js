import axios from 'axios';

function toggleNotificationContent(notification) {
    notification.classList.toggle('open');

    axios.post('/notifications/mark-as-read', (
        messages
    )).then(response => {
        messages = response.data.messages;
    }).catch(error => {
        console.log(error);
    });
}
document.addEventListener('DOMContentLoaded', () => {
    const notifications = document.querySelectorAll('.notification');
    // Toggle notification content on click
    notifications.forEach(notification => {
        notification.addEventListener('click', () => {
            toggleNotificationContent(notification);
        });
    });
    // Close notification content when clicking outside
    document.addEventListener('click', (event) => {
        const target = event.target;
        for (const notification of notifications) {
            if (!notification.contains(target)) {
                notification.classList.remove('open');
            }
        }
    });
});