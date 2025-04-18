<template>
    <section class="w-full">
        <header class="w-3/4 mx-auto p-4">
            HEADER Dashboard
        </header>
    </section>
    <section class="w-full bg-gray-50">
        <section class="mx-auto flex">
            <article class="w-1/2 p-4 mx-auto">
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
