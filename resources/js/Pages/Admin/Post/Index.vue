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
                    <option value="">All</option>
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
                v-for="post in postsData.data"
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

            <div>
                <a v-for="link in postsData.meta.links"
                   class="inline-block mr-2 px-3 py-1 bg-white border border-gray-700"
                   :href="link.url || '#'"
                   v-html="link.label"
                   @click.prevent="goToPage(link)"
                ></a>
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
        posts: Object
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
            page: 1,
            postsData: this.posts
        }
    },

    methods: {
        getPosts() {

            // const params = {
            //     ...this.filter,
            //     page: this.page
            // };

            // another approach for add url
            // const queryString = new URLSearchParams(params).toString();
            // window.history.pushState({}, '', `${window.location.pathname}?${queryString}`);

            axios.get(route('admin.posts.index'), {
                params: {
                    ...this.filter,
                    page: this.page
                }
            })
                .then(res => {
                    this.postsData = res.data
                    window.history.replaceState({}, document.title, res.request.responseURL)
                })
        },

        deletePost(post) {
            axios.delete(route('admin.posts.destroy', post.id))
                .then(res => {
                    this.getPosts()
                })
        },

        goToPage(link) {
            if (!link.url && link.label === '...') {
                const current = this.page;
                const last = this.postsData.meta.last_page;
                // let next = Math.min(current + 10, last);
                let next = last - 1;
                if (current > 10) {
                     // next = Math.min(current - 10, last);
                     next = current - 10;
                }
                this.page = next;
                this.getPosts();
                return;
            }

            if (!link.url) return;
            const match = link.url.match(/[\?&]page=(\d+)/);
            if (match) {
                this.page = parseInt(match[1]);
                this.getPosts();
            }
        }
    },

    mounted() {
        // debugger;
        this.filter = {
            is_published: null
        }
        this.page =  1
        window.history.replaceState({}, document.title, route('admin.posts.index'));
    },

    watch: {
        filter: {
            deep: true,
            handler() {
                this.page = 1;
                this.getPosts();
            }
        }
    }
}

</script>

<style scoped>

</style>
