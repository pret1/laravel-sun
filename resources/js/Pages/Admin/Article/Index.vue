<template>
    <div>
        <div v-for="article in articles" class="mb-4 pb-3 border-b border-gray-200">
            <Link :href="route('admin.articles.show', article.id)">{{ article.title }}</Link>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Index',

    components: {
        Link
    },

    props: {
        articles: Array
    }
}
</script>

<style scoped>

</style>
