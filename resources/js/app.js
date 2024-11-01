import './bootstrap';

Echo.channel('chatroom.' + chatroomId)
    .listen('MessageSent', (e) => {
        console.log('Message received:', e.message);
    // front end
    
    });
