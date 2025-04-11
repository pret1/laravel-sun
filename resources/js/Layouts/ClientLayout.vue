<template>
    <section class="w-full">
        <header class="w-3/4 mx-auto p-4">
            HEADER Dashboard
        </header>
    </section>
    <section class="w-full">
        <section class="w-3/4 mx-auto flex gap-4">
            <aside class="w-1/4 bg-white p-4 shadow">Sidebar</aside>
            <article class="w-3/4 p-4 bg-gray-50">
                <slot></slot>
            </article>
        </section>
    </section>
</template>

<script>
export default {
    name: 'ClientLayout',

}
</script>

<style scoped>

</style>
