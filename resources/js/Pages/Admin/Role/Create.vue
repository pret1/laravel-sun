<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.roles.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back</Link>
        </div>
        <div class="mb-4">
            <input v-model="role.title" type="text" placeholder="title" class="w-1/3 border border-gray-200">
        </div>
        <div>
            <a @click.prevent="storeRole" href="#"
               class="inline-block bg-emerald-700 px-3 py-1 text-white border border-emerald-800">Create</a>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: 'Create',

    layout: AdminLayout,

    components: {Link},

    data() {
        return {
            role: {}
        }
    },

    methods: {
        storeRole() {
            axios.post(route('admin.roles.store'), this.role)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>

<style scoped>

</style>
