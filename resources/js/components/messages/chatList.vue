<template>
    <div class="container py-8">
        <!-- Title -->
        <div class="mb-8">
            <h2 class="fw-bold m-0">Chats</h2>
        </div>

        <!-- Search -->
        <div class="mb-6">
            <form action="#">
                <div class="input-group">
                    <div class="input-group-text">
                        <div class="icon icon-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                    </div>

                    <input type="text" class="form-control form-control-lg ps-0" placeholder="Search messages or users"
                        aria-label="Search for messages or users...">
                </div>
            </form>
        </div>

        <!-- Chats -->
        <div class="card-list" id="chat-list">
                <a  v-for="conversation in conversations" v-bind:key="conversation.id" v-bind:href="'#' + conversation.id" @click.prevent=""  class="card border-0 text-reset">
                                            <div class="card-body">
                                                <div class="row gx-5">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-online">
                                                          <img v-bind:src="conversation.participants[0].avatar_url">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <h5 class="me-auto mb-0">{{ conversation.participants[0].name }}</h5>
                                                            <span class="text-muted extra-small ms-2">{{ moment(conversation.last_message.created_at).fromNow() }}</span>
                                                        </div>  

                                                        <div class="d-flex align-items-center">
                                                            <div class="line-clamp me-auto">
                                                                {{ conversation.last_message.body }}    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-body -->
                                        </a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            conversations: [],
        };
    },
    methods: {
        moment(time) {
            return moment(time);
        },
    },
    mounted(){
        fetch('/api/conversation')
            .then(response => response.json())
            .then(Json => {
                this.conversations = Json;
            });
    }

}
</script>