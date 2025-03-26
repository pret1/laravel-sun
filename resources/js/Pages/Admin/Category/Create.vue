<template>
    <div class="mb-4">
        <Link :href="route('admin.categories.index')"
                class="inline-block px-3 py-1 text-white bg-indigo-700 border border-indigo-800"
        >Back</Link>
    </div>
    <div class="mb-4">
        <input v-model="category.title" type="text" placeholder="title" class="border border-gray-200 w-1/3">
    </div>
    <div class="mb-4">
        <a @click.prevent="storeCategory" href="#"
           class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
        >Create</a>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Create',

    layout: AdminLayout,

    components: {Link},

    data() {
        return {
            category: {}
        }
    },

    methods: {
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
