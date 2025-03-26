<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.index')"
                    class="inline-block px-3 py-1 text-white bg-indigo-700 border border-indigo-800"
            >Back</Link>
        </div>
        <div>{{ category.title }}</div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {
    name: "Show",

    layout: AdminLayout,

    components: {Link},

    props: {
        category: Object
    }

}
</script>

<style scoped>

</style>
