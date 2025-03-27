<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.roles.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back</Link>
        </div>
        <div>
            {{ role.title }}
        </div>
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
        role: {}
    }
}
</script>

<style scoped>

</style>
