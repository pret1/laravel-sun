<template>
    <div>
        <div>
            <Link :href="route('admin.comments.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div>
            {{ comment.content }}
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
        comment: Object
    }
}
</script>

<style scoped>

</style>
