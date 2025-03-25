<template>
    <div class="p-4">
        <Link :href="route('admin.articles.create')"
              class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
        </Link>
    </div>
    <div>
        <div v-for="article in articles" class="mb-4 pb-3 border-b border-gray-200">
            <Link :href="route('admin.articles.show', article.id)">{{ article.title }}</Link>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
    name: 'Index',

    layout: AdminLayout,

    components: {
        Link
    },

    props: {
        articles: Array
    }
}
</script>

<style scoped>

</style>
