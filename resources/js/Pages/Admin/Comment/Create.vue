<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.comments.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div class="mb-4">
            <input v-model="comment.content" type="text" placeholder="content" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <a @click.prevent="storeComment" href="#"
               class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800">Create
            </a>
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

    data() {
        return {
            comment: {}
        }
    },

    methods: {
        storeComment() {
            axios.post(route('admin.comments.store'), this.comment)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>

<style scoped>

</style>
