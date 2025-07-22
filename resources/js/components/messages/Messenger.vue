<template>
    <main class="main is-visible" data-dropzone-area="">
        <div class="container h-100">

            <div class="d-flex flex-column h-100 position-relative">
                <!-- Chat: Header -->
                <chatHeader />
                <!-- Chat: Header -->

                <!-- Chat: Content -->
                <chatContent />
                <!-- Chat: Content -->

                <!-- Chat: Footer -->
                <chatFooter />
                <!-- Chat: Footer -->
            </div>

        </div>
    </main>
    <chatList />
</template>
<script>
import chatHeader from './chatHeader.vue'
import chatContent from './chatContent.vue'
import chatFooter from './chatFooter.vue'
import chatList from './chatList.vue'
export default {
    components: {
        chatHeader, chatContent, chatFooter , chatList
    },
};
</script>