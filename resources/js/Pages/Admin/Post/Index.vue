<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.create')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
            </Link>
        </div>
        <div class="mb-4 flex justify-between">
            <div>
                <input v-model="filter.title" type="text"  placeholder="title"/>
            </div>
            <div>
                <input v-model="filter.content" type="text"  placeholder="content"/>
            </div>
            <div>
                <input v-model="filter.likes_from" type="number" placeholder="likes"/>
            </div>
            <div>
                <input v-model="filter.views_from" type="number" placeholder="views"/>
            </div>
            <div class="mb-4">
                <input v-model="filter.published_at_from" type="date" placeholder="published at"/>
            </div>
            <div>
                <a @click.prevent="getPosts"
                   href="#"
                   class="inline-block bg-emerald-700 px-3 py-1 text-white border border-emerald-800" >Filter</a>
            </div>
        </div>
        <div>
            <div v-for="post in postsData" :key="post.id" class="mb-4 pb-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <Link :href="route('admin.posts.show', post.id)" class="text-blue-500"><h3>Title: {{ post.title }}</h3></Link>
                        Content: {{ post.content }}
                    </div>
                    <div>
                        <div>
                            likes: {{ post.likes }}
                        </div>
                        <div>
                            views: {{ post.views }}
                        </div>
                    </div>
                    <div>
                        author: {{ post.profile.name }}
                    </div>
                    <div>
                        <a @click.prevent="deletePost(post)" href="#" class="text-white inline-block bg-red-600 px-3 py-1">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";

export default {
    name: "Index",

    props: {
        posts: Array
    },

    layout: AdminLayout,

    components: {
        Link
    },

    data() {
        return {
            filter: {},
            postsData: this.posts
        }
    },

    methods: {
        getPosts() {
            axios.get(route('admin.posts.index'), {
                params: this.filter
            })
                .then(res => {
                    this.postsData = res.data
                })
        },

        deletePost(post) {
            axios.delete(route('admin.posts.destroy', post.id))
                .then(res => {
                    this.postsData = this.postsData.filter(postData => postData.id !== res.data.id)
                })
        }
    },

    watch: {
        filter: {
            deep: true,
            handler() {
                this.getPosts()
            }
        }
    }
}

</script>

<style scoped>

</style>
