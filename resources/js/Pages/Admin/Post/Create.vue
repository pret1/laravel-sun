<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div v-if="success" class="w-full bg-emerald-600 text-white mb-4 p-4">
            Post created.
        </div>
        <div>
            <div class="mb-4">
                <div v-if="errors['post.title']" class="text-red-500">
                    <p v-for="error in errors['post.title']">{{ error }}</p>
                </div>
                <input v-model="entries.post.title" type="text" class="border border-gray-200 w-1/3" placeholder="title">
            </div>
            <div class="mb-4">
                <div v-if="errors['post.content']" class="text-red-500">
                    <p v-for="error in errors['post.content']">{{ error }}</p>
                </div>
                <textarea v-model="entries.post.content" type="text" class="border border-gray-200 w-1/3" placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <div v-if="errors['post.published_at']" class="text-red-500">
                    <p v-for="error in errors['post.published_at']">{{ error }}</p>
                </div>
                <input v-model="entries.post.published_at" type="date" class="border border-gray-200 w-1/3" placeholder="date">
            </div>
            <div class="mb-4">
                <div v-if="errors['post.category_id']" class="text-red-500">
                    <p v-for="error in errors['post.category_id']">{{ error }}</p>
                </div>
                <select v-model="entries.post.category_id" class="border border-gray-200 w-1/3">
                    <option value="null" disabled selected>Chose category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <input v-model="entries.tags" type="text" class="border border-gray-200 w-1/3" placeholder="tags">
            </div>
            <div class="mb-4">
                <input ref="input_image" @change="addImage" type="file" class="border border-gray-200 w-1/3" placeholder="image">
            </div>
            <div class="mb-4">
                <a @click.prevent="storePost" href="#"
                      class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800">Create
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";

export default {
    name: 'Create',
    components: {Link},

    layout: AdminLayout,

    props: {
        categories: Array
    },

    data() {
        return {
            entries: {
                post: {
                    category_id: null,
                },
                tags: ""
            },
            errors: {},
            success: false
        }
    },

    methods: {
        storePost() {
            axios.post(route('admin.posts.store'), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    this.entries = {
                        post: {
                            category_id: null,
                        },
                        tags: ""
                    }
                    this.$refs.input_image.value = null
                    this.$nextTick(() => {
                        this.success = true
                    })
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
        },

        addImage(e){
            this.entries.image = e.target.files[0]
        }
    },

    watch: {
        entries: {
            handler() {
                this.success = false
            },
            deep: true
        }
    }
}

</script>

<style scoped>

</style>
