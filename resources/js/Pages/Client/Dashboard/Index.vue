<template>
    <div>
        <div v-for="post in postsData"
             class="mb-4 pb-4 border-b border-gray-200"
        >
            <div class="flex gap-4 items-start">
                <div class="flex-grow">
                        <h3 class="text-lg">Title: {{ post.title }}</h3>

                    <p class="text-gray-800">Content: {{ post.content }}</p>
                </div>
                <div class="ml-auto flex gap-4 items-start shrink-0">
                    <div class="w-32">
                        <p class="text-sm font-medium text-gray-600">Author:</p>
                        <p>{{ post.profile.name }}</p>
                    </div>
                    <div class="w-48">
                        <p class="text-sm font-medium text-gray-600 mb-1">Tags:</p>
                        <div class="flex flex-wrap gap-1">
                                <span
                                    v-for="tag in post.tag"
                                    :key="tag.id"
                                    class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full"
                                >
                                    {{ tag.title }}
                                </span>
                        </div>
                    </div>
                    <div class="w-24">
                        <p class="text-sm font-medium text-gray-600">Likes:</p>
                        <p>{{ post.likes }}</p>
                        <p class="text-sm font-medium text-gray-600">Views:</p>
                        <p>{{ post.views }}</p>
                    </div>
                    <div class="w-28">
                        <p class="text-sm font-medium text-gray-600">Published:</p>
                        <p>{{ post.is_published ? 'Yes' : 'No' }}</p>
                        <p class="text-sm font-medium text-gray-600">Category:</p>
                        <p>{{ post.category.title }}</p>
                    </div>
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

    mounted() {
        console.log(this.postsData);
    }

}
</script>

<style scoped>

</style>
