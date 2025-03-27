<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.tags.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back</Link>
        </div>
        <div class="mb-4">
            <input v-model="tag.title"
                   type="text"
                   name="title"
                   id="title"
                   placeholder="title"
                   class="w-1/3 border border-gray-200">
        </div>
        <div>
            <a @click.prevent="storeTag" href="#"
                class="inline-block bg-emerald-700 text-white px-3 py-1 border border-emerald-800"
            >Create</a>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Create',
    components: {Link},

    layout: AdminLayout,

    data() {
        return {
            tag: {}
        }
    },

    methods: {
        storeTag() {
            axios.post(route('admin.tags.store'), this.tag)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>

<style scoped>

</style>
