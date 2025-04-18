<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div v-if="success && !errorMessage" class="w-full bg-emerald-600 text-white mb-4 p-4">
            Post updated.
        </div>
        <div v-if="errorMessage" class="w-full bg-red-600 text-white mb-4 p-4">
            <p>{{ errorMessage }}</p>
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
                <input v-model="entries.post.published_at" type="datetime-local" class="border border-gray-200 w-1/3" placeholder="date">
            </div>
            <div class="mb-4">
                <div v-if="errors['post.category_id']" class="text-red-500">
                    <p v-for="error in errors['post.category_id']">{{ error }}</p>
                </div>
                <select v-model="entries.post.category_id" class="border border-gray-200 w-1/3">
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
                >
            </div>
            <div class="mb-4">
                <a @click.prevent="updatePost" href="#"
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
            entries: {
                post: this.post,
                tags: this.post.tags,
                image: '',
                _method: 'patch'
            },
            errors: {},
            errorMessage: "",
            success: false,
            previewImage: null,
        }
    },

    methods: {
        updatePost() {
            axios.post(route('admin.posts.update', this.entries.post.id), {
                ...this.entries,
                tags: typeof this.entries.tags === 'string'
                    ? this.entries.tags
                    : this.entries.tags.map(t => t.title).join(','),
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
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
                this.entries.image = e.target.files[0];
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
                return Array.isArray(this.entries.tags)
                    ? this.entries.tags.map(t => t.title).join(', ')
                    : this.entries.tags || '';
            },
            set(value) {
                this.entries.tags = value
                    .split(',')
                    .map(tag => tag.trim())
                    .filter(Boolean)
                    .join(',');
            }
        }
    }

}

</script>

<style scoped>

</style>
