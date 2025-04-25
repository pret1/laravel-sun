<template>
    <div class="mb-4 pb-4 border-b border-gray-200">
        <p>{{ commentItem.content }}</p>
        <span class="text-sm text-gray-500">{{ commentItem.published_at }}</span>
        <button @click.prevent="replyingTo = commentItem.id; getChildComments(commentItem.id)"
                class="flex inline-block px-3 py-1 bg-blue-700 text-white border border-blue-800"
        >Reply</button>
        <div v-if="replyingTo === commentItem.id" class="mb-4 p-4 border border-gray-200 bg-white">
            <div class="mb-4">
                <h3>Child Comments</h3>
            </div>
            <div>
                <CommentItem
                    v-for="child in childComments"
                    :key="child.id"
                    :comment-item="child"
                    :post="post"
                    @refresh-comments="getChildComments(commentItem.id)"
                />
            </div>
            <div class="mb-4">
                <textarea v-model="childComment.content" class="w-full"></textarea>
            </div>
            <div>
                <a @click.prevent="storeChildComment(commentItem.id)"
                   href="#"
                   class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
                >Send</a>
            </div>
        </div>
        <Like
            :item="commentItem"
            route-name="client.comment.like.toggle"
            :on-refresh="() => $emit('refresh-comments')"
            class="flex justify-end">
        </Like>
    </div>
</template>

<script>

import axios from "axios";
import Like from "@/Components/Like/Like.vue";

export default {
    name: "CommentItem",

    components: {
      Like
    },

    props: {
        commentItem: Object,
        post: Object
    },

    data() {
      return {
          replyingTo: null,
          childComments: [],
          childComment: {}
      }
    },

    methods: {
        getChildComments(commentId) {
            axios.get(route('client.comments.child-comments.index', {
                comment: commentId
            }))
                .then(res => {
                    this.childComments = res.data;
                })
        },

        storeChildComment(commentId) {
            axios.post(route('client.posts.child-comments.store', {
                post: this.post.id,
                comment: commentId
            }), this.childComment)
                .then(res => {
                    this.childComments.unshift(res.data)
                    this.childComment.content = ''
                })
        },
    }

}
</script>

<style scoped>

</style>
