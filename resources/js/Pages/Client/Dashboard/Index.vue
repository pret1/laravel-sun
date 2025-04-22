<template>
    <div>
        <PostItem v-for="post in postsData" :post="post"></PostItem>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import PostItem from "@/Components/Post/PostItem.vue";

export default {
    name: 'Index',
    components: {
        Link,
        PostItem
    },

    layout: ClientLayout,

    props: {
        posts: Array
    },

    data() {
        return {
            postsData: this.posts
        }
    },

}
</script>

<style scoped>

</style>
