<template>
    <div>
        <div>
            <div v-for="comment in comments" class="mb-4 pb-3 border-b border-gray-200">
                <Link :href="route('admin.comments.show', comment.id)">{{ comment.id }}</Link>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Index',
    components: {Link},

    props: {
        comments: Array
    }
}
</script>

<style scoped>

</style>
