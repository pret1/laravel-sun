<template>
    <div>
        <div>
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div>
            <div class="mb-4 pb-4 border-b border-gray-200">
                <h3>{{ post.title }}</h3>
                {{ post.content }}
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Show',
    components: {Link},

    props: {
        post: Object
    }
}

</script>

<style scoped>

</style>
