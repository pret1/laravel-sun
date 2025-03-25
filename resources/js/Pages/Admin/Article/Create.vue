<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.articles.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div>
            <div class="mb-4">
                <input v-model="article.title" type="text" class="border border-gray-200 w-1/3" placeholder="title">
            </div>
            <div class="mb-4">
                <textarea v-model="article.content" type="text" class="border border-gray-200 w-1/3"
                          placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <input v-model="article.published_at" type="date" class="border border-gray-200 w-1/3"
                       placeholder="date">
            </div>
            <div class="mb-4">
                <select v-model="article.category_id" class="border border-gray-200 w-1/3">
                    <option value="null" disabled selected>Chose category</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <a @click.prevent="storeArticle" href="#"
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

    layout: AdminLayout,

    components: {Link},

    props: {
        categories: Array
    },

    data() {
        return {
            article: {
                category_id: null
            }
        }
    },

    methods: {
        storeArticle() {
            axios.post(route('admin.articles.store'), this.article)
                .then(res => {
                    console.log(res)
                })
        }
    }


}
</script>

<style scoped>

</style>
