<template>
    <section class="w-full">
        <header class="w-3/4 mx-auto p-4">
            HEADER
        </header>
    </section>
    <section class="w-full">
        <section class="w-3/4 mx-auto flex">
            <aside class="w-1/4 bg-gray-900 min-h-screen">
                <div>
                    <Link :href="route('admin.posts.index')"
                          class="block p-4 border-gray-500 text-gray-300">Posts</Link>
                    <Link :href="route('admin.articles.index')"
                          class="block p-4 border-gray-500 text-gray-300">Articles</Link>
                    <Link :href="route('admin.comments.index')"
                          class="block p-4 border-gray-500 text-gray-300">Comments</Link>
                    <Link :href="route('admin.categories.index')"
                          class="block p-4 border-gray-500 text-gray-300">Categories</Link>
                    <Link :href="route('admin.profiles.index')"
                          class="block p-4 border-gray-500 text-gray-300">Profiles</Link>
                    <Link :href="route('admin.permissions.index')"
                          class="block p-4 border-gray-500 text-gray-300">Permissions</Link>
                    <Link :href="route('admin.roles.index')"
                          class="block p-4 border-gray-500 text-gray-300">Roles</Link>
                    <Link :href="route('admin.tags.index')"
                          class="block p-4 border-gray-500 text-gray-300">Tags</Link>
                    <Link :href="route('admin.statistics.index')"
                          class="block p-4 border-gray-500 text-gray-300">Statistics</Link>
                </div>
            </aside>
            <article class="w-3/4 p-4 bg-gray-50">
                <slot></slot>
            </article>
        </section>
    </section>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: 'AdminLayout',

    components: {Link}
}
</script>

<style scoped>

</style>
