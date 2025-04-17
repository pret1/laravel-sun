<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div v-if="success && !errorMessage" class="w-full bg-emerald-600 text-white mb-4 p-4">
            Post created.
        </div>
        <div v-if="errorMessage" class="w-full bg-red-600 text-white mb-4 p-4">
            <p>{{ errorMessage }}</p>
        </div>
        <div>
            <div class="mb-4">
                <div v-if="errors['post.title']" class="text-red-500">
                    <p v-for="error in errors['post.title']">{{ error }}</p>
                </div>
                <input v-model="post.title" type="text" class="border border-gray-200 w-1/3" placeholder="title">
            </div>
            <div class="mb-4">
                <div v-if="errors['post.content']" class="text-red-500">
                    <p v-for="error in errors['post.content']">{{ error }}</p>
                </div>
                <textarea v-model="post.content" type="text" class="border border-gray-200 w-1/3" placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <div v-if="errors['post.published_at']" class="text-red-500">
                    <p v-for="error in errors['post.published_at']">{{ error }}</p>
                </div>
                <input v-model="post.published_at" type="datetime-local" class="border border-gray-200 w-1/3" placeholder="date">
            </div>
            <div class="mb-4">
                <div v-if="errors['post.category_id']" class="text-red-500">
                    <p v-for="error in errors['post.category_id']">{{ error }}</p>
                </div>
                <select v-model="post.category.id" class="border border-gray-200 w-1/3">
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.title }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <input v-model="tagString" type="text" class="border border-gray-200 w-1/3" placeholder="tags">
            </div>
            <div class="mb-4">
                <img v-if="previewImage" :src="previewImage" :alt="post.title">
                <img v-else-if="post.image_url" :src="post.image_url" :alt="post.content">
                <input
                    ref="input_image"
                    @change="addImage"
                    type="file"
                    class="border border-gray-200 w-1/3"
                    placeholder="image"
                    multiple
                >
            </div>
            <div class="mb-4">
                <a @click.prevent="storePost" href="#"
                      class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800">Update
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
    name: 'Edit',
    components: {Link},

    layout: AdminLayout,

    props: {
        categories: Array,
        post: Object,
    },

    data() {
        return {
            errors: {},
            errorMessage: "",
            success: false,
            previewImage: null,
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
                    this.errorMessage = error.response.data.message
                    this.errors = error.response.data.errors
                })
        },

        addImage(e){
            const file = e.target.files[0]

            if (file) {
                this.previewImage = URL.createObjectURL(file)
                this.post.images = e.target.files
            }
        }
    },

    watch: {
        post: {
            handler() {
                this.success = false
                this.errorMessage = false
            },
            deep: true
        }
    },


    computed: {
        tagString: {
            get() {
                return this.post.tag?.map(t => t.title).join(', ') || '';
            },
            set(value) {
                this.post.tag = value
                    .split(',')
                    .map(tag => ({ title: tag.trim() }))
                    .filter(tag => tag.title);
            }
        }
    }

}

</script>

<style scoped>

</style>
