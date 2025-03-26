<template>
    <div class="mb-4">
        <Link :href="route('admin.profiles.create')"
                class="inline-block py-1 px-3 bg-indigo-700 text-white border border-indigo-800"
        >Create</Link>
    </div>
    <div>
        <div v-for="profile in profiles" class="mb-4">
            <Link :href="route('admin.profiles.show', profile.id)">{{ profile.name }}</Link>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
    name: 'Index',

    layout: AdminLayout,

    components: {Link},

    props: {
        profiles: Array
    }
}
</script>

<style scoped>

</style>
