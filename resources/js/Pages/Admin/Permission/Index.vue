<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.permissions.create')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
            </Link>
        </div>
        <div v-for="permission in permissions" class="mb-4 pb-3 border-b border-gray-200">
            <Link :href="route('admin.permissions.show', permission.id)">{{ permission.name }}</Link>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Index',
    components: {Link},

    layout: AdminLayout,

    props: {
        permissions: Array
    }
}
</script>

<style lang="scss" scoped>

</style>
