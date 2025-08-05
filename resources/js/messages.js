// import { createApp } from "vue";
// import Messenger from "./components/messages/Messenger.vue";
// import chatList from "./components/messages/chatList.vue";
// import Echo from "laravel-echo";
// import Pusher from "pusher-js";

// window.Pusher = Pusher;

// const chatApp = createApp({
//   data() {
//     return {
//       messages: [],
//       conversation: null,
//       userId: userId,          // Ensure this is globally defined
//       csrfToken: csrf_token,   // Ensure this is globally defined
//       laravelEcho: null,
//       usersInChannel: [],
//     };
//   },
//   mounted() {
//     window.Pusher.logToConsole = true; // Enable Pusher logs for debugging

//     this.laravelEcho = new Echo({
//       broadcaster: "pusher",
//       key: import.meta.env.VITE_PUSHER_APP_KEY,
//       cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//       forceTLS: true,
//     });

//     this.laravelEcho
//       .join(`presence-Messenger.${this.userId}`)
//       .here((users) => {
//         this.usersInChannel = users;
//         console.log("Users currently in channel:", users);
//       })
//       .joining((user) => {
//         this.usersInChannel.push(user);
//         console.log("User joined:", user);
//       })
//       .leaving((user) => {
//         this.usersInChannel = this.usersInChannel.filter(u => u.id !== user.id);
//         console.log("User left:", user);
//       })
//       .listen("MessageCreated", (data) => {
//         console.log("Received data:", data);
//         if (data.message) {
//           alert(data.message.body); // Adjust based on actual structure
//           this.messages.push(data.message);
//         } else {
//           console.warn("No message found in event payload");
//         }
//       });
//   },
//   methods: {
//     moment(time) {
//       return moment(time);
//     },
//   },
// });

// chatApp.component("chatList", chatList);
// chatApp.component("Messenger", Messenger);
// chatApp.mount("#chat-app");

//***********************************************************************************************************************************************************/

import { createApp } from "vue";
import Messenger from "./components/messages/Messenger.vue";
import chatList from "./components/messages/chatList.vue";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

const chatApp = createApp({
    data() {
        return {
            messages: [],
            conversation: null,
            userId: userId, // Make sure this is defined globally
            csrfToken: csrf_token, // Make sure this is defined globally
            laravelEcho: null,
            usersInChannel: [], // to track presence members if you want
        };
    },
    mounted() {
        this.laravelEcho = new Echo({
            broadcaster: "pusher",
            key: import.meta.env.VITE_PUSHER_APP_KEY,
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
            forceTLS: true,
        });

        // Join presence channel - no space in channel name!
        this.laravelEcho
            .join(`Messenger.${this.userId}`)
            .listen(".new-message", (data) => {
                alert(data.message.body);
                this.messages.push(data.message);
            })
            .joining((user) => {
                // When a new user joins
                this.usersInChannel.push(user);
                console.log("User joined:", user);
            })
            .leaving((user) => {
                // When a user leaves
                this.usersInChannel = this.usersInChannel.filter(
                    (u) => u.id !== user.id
                );
                console.log("User left:", user);
            })
            .listen("MessageCreated", (data) => {
                alert(data.message);
                console.log(this.messages.push(data.message));
                this.messages.push(data.message);
            });
    },
    methods: {
        moment(time) {
            return moment(time);
        },
    },
});

chatApp.component("chatList", chatList);
chatApp.component("Messenger", Messenger);
chatApp.mount("#chat-app");

//***********************************************************************************************************************************************************/

// import { createApp } from "vue";
// import Messenger from "./components/messages/Messenger.vue";
// import chatList from "./components/messages/chatList.vue";
// import Echo from "laravel-echo";
// import Pusher from "pusher-js";
// // import laravel from "laravel-vite-plugin";

// window.Pusher = Pusher;

// // const app = createApp(Messenger);
// // app.mount('#chat-app');
// const chatApp = createApp({
//     data() {
//         return {
//             messages: [],
//             conversation: null,
//             userId: userId,
//             csrfToken: csrf_token,
//             laravelEcho: null,
//         };
//     },
//     mounted() {
//         this.laravelEcho = new Echo({
//             broadcaster: "pusher",
//             key: import.meta.env.VITE_PUSHER_APP_KEY,
//             cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//             forceTLS: true,
//             encrypted: true,
//         });
//         this.laravelEcho
//             .join(`Messenger. ${this.userId}`)
//             .listen("message-created", (data) => {
//                 alert(data.message.body);
//                 this.messages.push(data.message);
//             });
//     },
//     methods: {
//         moment(time) {
//             return moment(time);
//         },
//     },
// });
// chatApp.component("chatList", chatList);
// chatApp.component("Messenger", Messenger);
// chatApp.mount("#chat-app");

// التطبيق الثاني - يركب على #chatList
// const app2 = createApp(chatList);  // أو تقدر تستبدل بـ AnotherComponent لو تبي
// app2.mount('#chat-list');
