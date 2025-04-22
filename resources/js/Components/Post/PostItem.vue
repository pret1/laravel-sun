<template>
    <div class="mb-4 p-4 border border-gray-200 bg-white">
        <div class="items-center">
            <div>
                <Link class="text-lg" :href="route('client.posts.show', post.id)">Title: {{ post.title }}</Link>
                <p class="text-gray-800">Content: {{ post.content }}</p>
                <img v-if="post.image_url" :alt="post.title" :src="post.image_url">
                <div class="flex justify-end">
                    <span>{{ post.liked_profiles_count }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" :fill="post.liked_profiles_count > 0 ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "PostItem",

    components: {Link},

    props: {
        post: Object
    }

}
</script>

<style scoped>

</style>
