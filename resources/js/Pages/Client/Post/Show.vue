<template>
    <div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="items-center">
                <div>
                    <p class="mb-4 text-gray-800">Content: {{ post.content }}</p>
                    <img v-if="post.image_url" :alt="post.title" :src="post.image_url" class="mb-4">
                    <div class="flex justify-end">
                        <span>{{ post.liked_profiles_count }}</span>
                        <svg @click="toggleLike" xmlns="http://www.w3.org/2000/svg"
                             :fill="post.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="cursor-pointer size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="mb-4">
                <h3>Add comments</h3>
            </div>
            <div class="mb-4">
                <textarea v-model="comment.content" class="w-full"></textarea>
            </div>
            <div>
                <a @click.prevent="storeComment"
                   href="#"
                   class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
                >Send</a>
            </div>
        </div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="mb-4">
                <h3>Comments</h3>
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
    components: {Link},

    layout: ClientLayout,

    props: {
        post: Object
    },

    data() {
        return {
            comment: {}
        }
    },

    methods: {
        toggleLike() {
            axios.post(route('client.posts.like.toggle', this.post.id))
                .then(res => {
                    console.log(res)
                    this.post.is_liked = res.data.is_liked
                    this.post.liked_profiles_count = res.data.liked_profiles_count;
                })
        },

        storeComment() {
            axios.post(route('client.posts.comments.store', this.post.id), this.comment)
                .then(res => {
                    console.log(res);
                })
        }
    }

}
</script>

<style scoped>

</style>
