<template>
    <div>
        <div class="mb-8">
            <h2 class="text-lg font-bold mb-4">Original Posts</h2>
            <PostItem
                v-for="post in originalPosts"
                :key="post.id"
                :post="post"
                @post_deleted="refreshPosts"
            ></PostItem>
        </div>

        <div>
            <h2 class="text-lg font-bold mb-4">Reposts</h2>
            <PostItem
                v-for="post in reposts"
                :key="post.id"
                :post="post"
                @post_deleted="refreshPosts"
            ></PostItem>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import PostItem from "@/Components/Post/PostItem.vue";

export default {
    name: 'Index',
    components: {
        Link,
        PostItem
    },

    layout: ClientLayout,

    props: {
        posts: Array
    },

    data() {
        return {
            postsData: this.posts,
        }
    },


    computed: {
        originalPosts() {
            return this.postsData.filter(post => !post.parent_id);
        },

        reposts() {
            return this.postsData.filter(post => post.parent_id);
        }
    },

    methods: {
        refreshPosts(post) {
            this.postsData = this.postsData.filter(postData => postData !== post)
        }
    },

}
</script>

<style scoped>

</style>
