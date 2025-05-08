<template>
    <div>

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

</style>
