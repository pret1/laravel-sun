<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.tags.create')"
                  class="bg-indigo-700 inline-block px-3 py-1 text-white border border-indigo-800">Create</Link>
        </div>
        <div v-for="tag in tags" class="mb-4 border-b border-gray-200">
            <Link :href="route('admin.tags.show', tag.id)">{{ tag.title }}</Link>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Index',

    layout: AdminLayout,

    components: {Link},

    props: {
        tags: Array
    }
}
</script>

<style scoped>

</style>
