<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.permissions.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div class="mb-4 pb-4 border-b border-gray-200">
            {{ permission.name }}
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
        permission: Object
    }
}
</script>

<style lang="scss" scoped>

</style>
