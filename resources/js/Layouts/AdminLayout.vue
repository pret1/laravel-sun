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
