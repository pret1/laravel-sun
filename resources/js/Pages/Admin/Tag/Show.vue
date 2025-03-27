<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.tags.index')"
                  class="inline-block bg-indigo-700 px-3 py-1 text-white border border-indigo-800">Back</Link>
        </div>
        <div>{{ tag.title }}</div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Show',

    layout: AdminLayout,

    components: {Link},

    props: {
        tag: Object
    },
}
</script>

<style scoped>

</style>
