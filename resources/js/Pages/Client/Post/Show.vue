<template>
    <div>
        <div v-if="isRepost" class="popup flex justify-center items-center">
            <div class="body p-4">
                <div class="mb-4">
                    <input v-model="repost.title" type="text" class="border border-gray-200 w-full" placeholder="title">
                </div>
                <div class="mb-4">
                    <textarea v-model="repost.content" type="text" class="border border-gray-200 w-full" placeholder="content"></textarea>
                </div>
                <div class="mb-4">
                    <a @click.prevent="repostPost"
                        href="#"
                        class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
                    >Repost</a>
                </div>
                <div @click="isRepost = false" class="cursor-pointer text-white">
                    Close
                </div>
            </div>
        </div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="items-center">
                <div>
                    <p class="mb-4 text-gray-800">Content: {{ post.content }}</p>
                    <img v-if="post.image_url" :alt="post.title" :src="post.image_url" class="mb-4">
                    <div class="flex justify-end">
                        <div>
                            <svg @click="isRepost = true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="cursor-pointer mr-4 size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                            </svg>
                        </div>
                        <div>
                            <Like
                                :item="post"
                                route-name="client.posts.like.toggle"
                                class="flex justify-end">
                            </Like>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="items-center">
                <div class="mb-4">
                    <h3>Reposts</h3>
                </div>
                <div v-for="repostItem in reposts" :key="repostItem.id" class="mb-4">
                    <p class="mb-4 text-gray-800">Content: {{ repostItem.title }}</p>
                    <img v-if="repostItem.image_url" :alt="repostItem.title" :src="repostItem.image_url" class="mb-4">
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
      this.getReposts()
    },

    data() {
        return {
            comment: {},
            comments: [],
            childComments: [],
            replyingTo: null,
            childComment: {},
            isRepost: false,
            repost: {},
            reposts: [],
        }
    },

    methods: {
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

        getReposts() {
            axios.get(route('client.posts.reposts.index', this.post.id))
                .then(res => {
                    this.reposts = res.data
                })
        },

        repostPost() {
            axios.post(route('client.posts.repost', this.post.id), this.repost)
                .then(res => {
                    this.reposts.unshift(res.data)
                    this.isRepost = false
                })
        }

    }

}
</script>

<style>
    .popup {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        left: 0;
        top: 0;
    }

    .body {
        width: 40%;
        height: 40%;
        background: #323243;
        left: 0;
        top: 0;
    }
</style>
