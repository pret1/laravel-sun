<template>
    <div>
        <div>
            <div v-for="post in posts" class="mb-4 pb-4 border-b border-gray-200">
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
