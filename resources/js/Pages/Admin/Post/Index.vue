<template>
<div>
    <div>
        <div v-for="post in posts" class="mb-4 pb-4 border-b border-gray-200">
            {{ post.title }}
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Index",

    props: {
        posts: Array
    }
}

</script>

<style scoped>

</style>
