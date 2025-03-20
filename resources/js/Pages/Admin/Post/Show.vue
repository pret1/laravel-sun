<template>
    <div>
        <div>
            <div class="mb-4 pb-4 border-b border-gray-200">
                <h3>{{ post.title }}</h3>
                {{ post.content }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Show',

    props: {
        post: Object
    }
}

</script>

<style scoped>

</style>
