import Messenger from './components/messages/Messenger.vue';
import chatList from './components/messages/chatList.vue';
import { createApp } from 'vue';

const app = createApp(Messenger);
app.mount('#chat-app');

// التطبيق الثاني - يركب على #chatList
const app2 = createApp(chatList);  // أو تقدر تستبدل بـ AnotherComponent لو تبي
app2.mount('#chat-list');   
