<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.comments.create')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
            </Link>
        </div>
        <div>
            <div v-for="comment in comments" :id="comment.id" class="mb-4 pb-3 border-b border-gray-200">
                <Link :href="route('admin.comments.show', comment.id)">{{ comment.content }}</Link>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: 'Index',

    components: {Link},

    layout: AdminLayout,

    props: {
        comments: Array
    }
}
</script>

<style scoped>

</style>
