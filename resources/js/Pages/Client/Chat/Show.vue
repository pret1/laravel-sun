<template>
    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ chat.id }}
            </div>
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div v-if="hasMoreMessages" class="mt-4 text-center">
                    <button
                        @click="loadMoreMessages"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 border border-gray-400 rounded"
                    >
                        Load More
                    </button>
                </div>
                <div class="overflow-y-auto h-64">
                    <div v-for="message in visibleMessages" class="mb-4 p-4 border-b border-gray-200">
                        {{message.content}}
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
        chat: Object
    },

    data() {
        return {
            message: {},
            visibleMessages: [],
            currentPage: 1,
            perPage: 5,
            hasMoreMessages: true
        }
    },

    methods: {
        storeMessage() {
            axios.post(route('client.chats.messages.store', this.chat.id), this.message)
                .then(res => {
                    this.chat.messages.push(res.data)
                    this.message = {};
                    this.updateVisibleMessages();
                })
        },

        loadMoreMessages() {
            this.currentPage++;
            this.updateVisibleMessages();
        },

        updateVisibleMessages() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = this.currentPage * this.perPage;

            this.visibleMessages = this.chat.messages.slice(-end).reverse();

            this.hasMoreMessages = this.chat.messages.length > this.visibleMessages.length;
        }
    },

    mounted() {
        this.updateVisibleMessages();
    }

}
</script>

<style>

</style>
