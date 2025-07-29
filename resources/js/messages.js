import { createApp } from 'vue';
import Messenger from './components/messages/Messenger.vue';
import chatList from './components/messages/chatList.vue';

// const app = createApp(Messenger);
// app.mount('#chat-app');
const chatApp= createApp({
    data(){
        return {
            conversation: null,
            messages: [],
            userId :userId,
            csrfToken : csrf_token
}
    },
    methods:{
        moment(time) {
            return moment(time);
        },
    }
})
chatApp.component('chatList',chatList);
chatApp.component('Messenger',Messenger);
chatApp.mount('#chat-app');
// التطبيق الثاني - يركب على #chatList
// const app2 = createApp(chatList);  // أو تقدر تستبدل بـ AnotherComponent لو تبي
// app2.mount('#chat-list');   
