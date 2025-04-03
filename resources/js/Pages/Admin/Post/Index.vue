<template>
    <div>
        <div class="p-4">
            <Link :href="route('admin.posts.create')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
            </Link>
        </div>
        <div>
            <div v-for="post in posts" :key="post.id" class="mb-4 pb-4 border-b border-gray-200">
                <Link :href="route('admin.posts.show', post.id)">{{ post.title }}</Link>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: {
        posts: Array
    },

    layout: AdminLayout,

    components: {
        Link
    }
}

</script>

<style scoped>

</style>
