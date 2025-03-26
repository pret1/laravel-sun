<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.profiles.index')"
                    class="inline-block px-3 py-1 text-white bg-indigo-700 border border-indigo-800"
            >Back</Link>
        </div>
        <div class="mb-4">
            {{profile.name}} <br>
            {{profile.phone}} <br>
            {{profile.address}} <br>
            {{profile.gender}}
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
export default {
    name: 'Show',

    layout: AdminLayout,

    components: {Link},

    props: {
        profile: Object
    }
}
</script>

<style scoped>

</style>
