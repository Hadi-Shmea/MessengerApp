<template>
    <main class="main is-visible" data-dropzone-area="">
        <div class="container h-100">

            <div class="d-flex flex-column h-100 position-relative">
                <!-- Chat: Header -->
                <chatHeader :conversation='conversation' />
                <!-- Chat: Header -->

                <!-- Chat: Content -->
                <chatContent :conversation='conversation' />
                <!-- Chat: Content -->

                <!-- Chat: Footer -->
                <chatFooter :conversation='conversation' />
                <!-- Chat: Footer -->
            </div>

        </div>
    </main>
</template>
<script>
import chatHeader from './chatHeader.vue'
import chatContent from './chatContent.vue'
import chatFooter from './chatFooter.vue'
export default {
    components: {
        chatHeader, chatContent, chatFooter
    },
    props: [
        'conversation', 'messages'
    ],
    data() {
        return {
            messages: [],
        };
    },
}
</script>