<template>
    <div>
        <div>
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div>
            <div class="mb-4 pb-4 border-b border-gray-200">
                <div><h3>{{ post.title }}</h3></div>
                <div>{{ post.content }}</div>
                <div>
                    <img :src="post.image_url" :alt="post.title">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: 'Show',
    components: {Link},

    layout: AdminLayout,

    props: {
        post: Object
    }
}

</script>

<style scoped>

</style>
