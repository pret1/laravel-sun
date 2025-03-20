<template>
<div>
    <div>
        <div v-for="post in posts">
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
