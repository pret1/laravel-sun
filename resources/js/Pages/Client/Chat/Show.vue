<template>
    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ chat.data.id }}
            </div>
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div v-if="nextPageUrl" class="mt-4 text-center">
                    <button
                        @click="loadMoreMessages"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 border border-gray-400 rounded"
                    >
                        Load More
                    </button>
                </div>
                <div v-if="unreadCount > 0" class="mb-2 text-red-600 font-bold">
                    Unread messages: {{ unreadCount }}
                </div>
                <div class="overflow-y-auto h-64">
                    <div v-for="message in allMessages"
                         :class="[
                            message.is_self ? 'text-right' : 'text-left',
                            'mb-4 p-4 border-b border-gray-200',
                            message.is_unread ? 'bg-yellow-100' : ''
                         ]">
                        {{message.content}}
                        <small class="text-gray-500">
                            {{ message.is_self ? 'your' : message.author_name }}
                        </small>
                        <span class="ml-2 align-middle">
                            <span v-if="message.read_at">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-emerald-600 inline">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                                </svg>
                            </span>
                            <span v-else>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-400 inline">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div class="mb-4">
                    <textarea v-model="message.content" placeholder="message" class="w-full"></textarea>
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeMessage" href="#"
                       class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800">Send
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: 'Show',
    components: {
        Link,
    },

    layout: ClientLayout,

    props: {
        chat: Object,
        messages: Object,
        unreadCount: Number
    },

    data() {
        return {
            message: {},
            allMessages: this.messages.data.reverse(),
            nextPageUrl: this.messages.links.next
        }
    },

    methods: {
        storeMessage() {
            axios.post(route('client.chats.messages.store', this.chat.data.id), this.message)
                .then(res => {
                    this.allMessages.push(res.data)
                    this.message = {};
                })
        },

        loadMoreMessages() {
            if (!this.nextPageUrl) return;

            axios.get(this.nextPageUrl)
                .then(res => {
                    this.allMessages = [...res.data.messages.reverse(), ...this.allMessages];
                    this.nextPageUrl = res.data.links[5].url;
            });
        },
    },

}
</script>

<style>

</style>
