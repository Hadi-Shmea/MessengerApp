<template>
    <div class="chat-footer pb-3 pb-lg-7 position-absolute bottom-0 start-0">
        <!-- Chat: Files -->
        <div class="dz-preview bg-dark" id="dz-preview-row" data-horizontal-scroll="">
        </div>
        <!-- Chat: Files -->

        <!-- Chat: Form -->
        <form class="chat-form rounded-pill bg-dark" data-emoji-form="" method="post"
            action="/api/messages">
            <input type="hidden" name="_token" :value="csrf_token">
            <input type="hidden" name="conversation_id">
            <div class="row align-items-center gx-0">
                <div class="col-auto">
                    <a href="#" class="btn btn-icon btn-link text-body rounded-circle" id="dz-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-paperclip">
                            <path
                                d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="col">
                    <div class="input-group">
                        <textarea name="message" class="form-control px-0" placeholder="Type your message..." rows="1"
                            data-emoji-input="" data-autosize="true"></textarea>

                        <a href="#" class="input-group-text text-body pe-0" data-emoji-btn="">
                            <span class="icon icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-smile">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="col-auto">
                    <button class="btn btn-icon btn-primary rounded-circle ms-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-send">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <!-- Chat: Form -->
    </div>
</template>
<script>
    export default {};
</script>