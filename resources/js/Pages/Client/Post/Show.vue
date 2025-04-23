<template>
    <div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="items-center">
                <div>
                    <p class="mb-4 text-gray-800">Content: {{ post.content }}</p>
                    <img v-if="post.image_url" :alt="post.title" :src="post.image_url" class="mb-4">
                    <Like
                        :item="post"
                        route-name="client.posts.like.toggle"
                        class="flex justify-end">
                    </Like>
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
            <div>
                <CommentItem
                    v-for="commentItem in comments"
                    :commentItem="commentItem"
                    :post="post"
                    @refresh-comments="getComments"
                    class="mb-4 pb-4 border-b border-gray-200">
                </CommentItem>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import CommentItem from "@/Components/Comment/CommentItem.vue";
import Like from "@/Components/Like/Like.vue";

export default {
    name: 'Show',
    components: {
        Link,
        CommentItem,
        Like
    },

    layout: ClientLayout,

    props: {
        post: Object
    },

    mounted() {
      this.getComments()
    },

    data() {
        return {
            comment: {},
            comments: [],
            childComments: [],
            replyingTo: null,
            childComment: {}
        }
    },

    methods: {
        toggleLikePost() {
            axios.post(route('client.posts.like.toggle', this.post.id))
                .then(res => {
                    this.post.is_liked = res.data.is_liked
                    this.post.liked_profiles_count = res.data.liked_profiles_count;
                })
        },

        storeComment() {
            axios.post(route('client.posts.comments.store', this.post.id), this.comment)
                .then(res => {
                    this.comments.unshift(res.data)
                    this.comment.content = ''
                })
        },

        getComments() {
            axios.get(route('client.posts.comments.index', this.post.id))
                .then(res => {
                    this.comments = res.data
                })
        },

    }

}
</script>

<style scoped>

</style>
