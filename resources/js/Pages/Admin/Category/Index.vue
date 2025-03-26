<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.create')"
                    class="inline-block py-1 px-3 text-white bg-indigo-700 border border-indigo-800"
            >Create</Link>
        </div>
        <div v-for="category in categories" class="mb-4">
            <Link :href="route('admin.categories.show', category.id)">{{ category.title }}</Link>
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
        categories: Array
    }
}
</script>

<style scoped>

</style>
