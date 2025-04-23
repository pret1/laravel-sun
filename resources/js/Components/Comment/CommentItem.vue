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
                <div v-for="commentItemChild in childComments" class="mb-4 pb-4 border-b border-gray-200">
                    <p>{{ commentItemChild.content }}</p>
                    <span class="text-sm text-gray-500">{{ commentItemChild.published_at }}</span>
                    <div class="flex justify-end">
                        <span>{{ commentItemChild.likes }}</span>
                        <svg @click="toggleLikeComment(commentItemChild.id, commentItem)" xmlns="http://www.w3.org/2000/svg"
                             :fill="commentItemChild.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="cursor-pointer size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                    </div>
                </div>
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
        <div class="flex justify-end">
            <span>{{ commentItem.likes }}</span>
            <svg @click="toggleLikeComment(commentItem.id)" xmlns="http://www.w3.org/2000/svg"
                 :fill="commentItem.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="cursor-pointer size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    name: "CommentItem",

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

        toggleLikeComment(commentId, parentComment) {
            axios.post(route('client.comment.like.toggle', commentId))
                .then(res => {
                    this.$emit('refresh-comments');

                    if(parentComment) {
                        this.replyingTo = parentComment.id
                        this.getChildComments(parentComment)
                    }
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
