<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.create')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Create
            </Link>
        </div>
        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <input v-model="filter.title" type="text" placeholder="Title"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <input v-model="filter.content" type="text" placeholder="Content"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <input v-model="filter.likes_from" type="number" placeholder="Likes"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <input v-model="filter.views_from" type="number" placeholder="Views"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <select v-model="filter.is_published" class="w-full border border-gray-300 p-1">
                    <option value="null" disabled selected>Is published</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <input v-model="filter.tags" type="text" placeholder="Tags" class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <input v-model="filter.category_title" type="text" placeholder="Category"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <input v-model="filter.published_at_from" type="date" placeholder="Published at"
                       class="w-full border border-gray-300 p-1"/>
            </div>
            <div>
                <a @click.prevent="getPosts"
                   href="#"
                   class="inline-block bg-emerald-700 w-full px-3 py-1 text-white border border-emerald-800 text-center">
                    Filter
                </a>
            </div>
        </div>

        <div>
            <div
                v-for="post in postsData"
                :key="post.id"
                class="mb-4 pb-4 border-b border-gray-200"
            >
                <div class="flex gap-4 items-start">
                    <div class="flex-grow">
                        <Link
                            :href="route('admin.posts.show', post.id)"
                            class="text-blue-600 font-semibold"
                        >
                            <h3 class="text-lg">Title: {{ post.title }}</h3>
                        </Link>
                        <p class="text-gray-800">Content: {{ post.content }}</p>
                    </div>
                    <div class="ml-auto flex gap-4 items-start shrink-0">
                        <div class="w-32">
                            <p class="text-sm font-medium text-gray-600">Author:</p>
                            <p>{{ post.profile.name }}</p>
                        </div>
                        <div class="w-48">
                            <p class="text-sm font-medium text-gray-600 mb-1">Tags:</p>
                            <div class="flex flex-wrap gap-1">
                                <span
                                    v-for="tag in post.tag"
                                    :key="tag.id"
                                    class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full"
                                >
                                    {{ tag.title }}
                                </span>
                            </div>
                        </div>
                        <div class="w-24">
                            <p class="text-sm font-medium text-gray-600">Likes:</p>
                            <p>{{ post.likes }}</p>
                            <p class="text-sm font-medium text-gray-600">Views:</p>
                            <p>{{ post.views }}</p>
                        </div>
                        <div class="w-28">
                            <p class="text-sm font-medium text-gray-600">Published:</p>
                            <p>{{ post.is_published ? 'Yes' : 'No' }}</p>
                            <p class="text-sm font-medium text-gray-600">Category:</p>
                            <p>{{ post.category.title }}</p>
                        </div>
                        <div class="self-center">
                            <a
                                @click.prevent="deletePost(post)"
                                href="#"
                                class="text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700"
                            >
                                Delete
                            </a>
                        </div>
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
            filter: {
                is_published: null
            },
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

    // mounted() {
    //     debugger;
    // },

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
