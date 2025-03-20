<template>
    <div>
        <div>
            <Link :href="route('admin.articles.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div class="mb-4 pb-4 border-b border-gray-200">
            <h3>{{ article.title }}</h3>
            {{ article.content }}
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Show',

    components: {Link},

    props: {
        article: Object
    }
}
</script>

<style scoped>

</style>
