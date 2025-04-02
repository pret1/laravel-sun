<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div>
            <div class="mb-4">
                <input v-model="post.title" type="text" class="border border-gray-200 w-1/3" placeholder="title">
            </div>
            <div class="mb-4">
                <textarea v-model="post.content" type="text" class="border border-gray-200 w-1/3" placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <input v-model="post.published_at" type="date" class="border border-gray-200 w-1/3" placeholder="date">
            </div>
            <div class="mb-4">
                <select v-model="post.category_id" class="border border-gray-200 w-1/3">
                    <option value="null" disabled selected>Chose category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <input @change="addImage" type="file" class="border border-gray-200 w-1/3" placeholder="image">
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
            post: {
                category_id: null,
            }
        }
    },

    methods: {
        storePost() {
            axios.post(route('admin.posts.store'), this.post, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    console.log(res);
                })
        },

        addImage(e){
            this.post.image = e.target.files[0]
        }
    }
}

</script>

<style scoped>

</style>
