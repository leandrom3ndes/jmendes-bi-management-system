import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '395870449facb1904e42',
    cluster: 'eu',
    encrypted: false
});