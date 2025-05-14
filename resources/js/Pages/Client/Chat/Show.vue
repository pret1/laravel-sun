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
                <div class="overflow-y-auto h-64">
                    <div v-for="message in allMessages"
                         :class="[message.is_self ? 'text-right' : 'text-left','mb-4 p-4 border-b border-gray-200']">
                        {{message.content}}
                        <small class="text-gray-500">
                            {{ message.is_self ? 'your' : message.author_name }}
                        </small>
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
        messages: Object
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
