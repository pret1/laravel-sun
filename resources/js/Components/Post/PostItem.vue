<template>
    <div class="mb-4 p-4 border border-gray-200 bg-white">
        <div class="items-center">
            <div>
                <Link class="text-lg" :href="route('client.posts.show', post.id)">Title: {{ post.title }}</Link>
                <p class="text-gray-800">Content: {{ post.content }}</p>
                <img v-if="post.image_url" :alt="post.title" :src="post.image_url">
                <div class="flex justify-end">
                    <span>{{ post.liked_profiles_count }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" :fill="post.liked_profiles_count > 0 ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
                <div>
                    <svg @click="deletePost" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 cursor-pointer size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>
            </div>
        </div>

        <div @click="changePerson">changePerson</div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "PostItem",

    components: {Link},

    props: {
        post: Object
    },

    methods: {
        deletePost() {
            axios.delete(route('client.posts.destroy', this.post.id))
                .then(res => {
                    this.$emit('post_deleted', this.post)
                })
        },

        changePerson() {
            // window.dispatchEvent(new CustomEvent('foo-key-localstorage-changed', {
            //     detail: {
            //         storage: {
            //             name: 'Vano'
            //         }
            //     }
            // }));

            this.$page.props.person = 'Sergo'
        }
    }

}
</script>

<style scoped>

</style>
