<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.permissions.index')"
                  class="inline-block px-3 py-1 bg-indigo-700 text-white border border-indigo-800">Back
            </Link>
        </div>
        <div class="mb-4">
            <input v-model="permission.name" type="text" placeholder="name" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <a @click.prevent="storePermission" href="#"
                class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
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
            permission: {}
        }
    },

    methods: {
        storePermission() {
            axios.post(route('admin.permissions.store'), this.permission)
                .then(res => {
                    console.log(res);
                })
        }
    }
}
</script>

<style scoped>

</style>
