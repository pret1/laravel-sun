<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.roles.create')"
                  class="bg-indigo-700 inline-block px-3 py-1 text-white border border-indigo-800">Create</Link>
        </div>
        <div v-for="role in roles" class="mb-4 border-b border-gray-200">
            <Link :href="(route('admin.roles.show', role.id))">{{ role.title }}</Link>
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
        roles: Array
    }
}
</script>

<style scoped>

</style>
