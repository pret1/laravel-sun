<template>
    <div>
        <div v-for="post in postsData"
             class="mb-4 p-4 border border-gray-200 bg-white"
        >
            <div class="items-center">
                <div>
                    <Link class="text-lg" :href="route('client.posts.show', post.id)">Title: {{ post.title }}</Link>
                    <p class="text-gray-800">Content: {{ post.content }}</p>
                    <img v-if="post.image_url" :alt="post.title" :src="post.image_url">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Index',
    components: {Link},

    layout: ClientLayout,

    props: {
        posts: Array
    },

    data() {
        return {
            postsData: this.posts
        }
    },

}
</script>

<style scoped>

</style>
