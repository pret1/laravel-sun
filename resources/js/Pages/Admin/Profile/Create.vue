<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.profiles.index')"
                    class="inline-block px-3 py-1 text-white bg-indigo-700 border border-indigo-800"
            >Back</Link>
        </div>
        <div class="mb-4">
            <input v-model="profile.name" type="text" placeholder="name" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <input v-model="profile.phone" type="text" placeholder="phone" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <input v-model="profile.address" type="text" placeholder="address" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <select v-model="profile.gender" class="border border-gray-200 w-1/3">
                <option value="null" disabled selected>Chose gender</option>
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>
        <div>
            <a @click.prevent="storeProfile" href="#"
                class="inline-block px-3 py-1 bg-emerald-700 text-white border border-emerald-800"
            >Create</a>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
export default {
    name: 'Show',

    layout: AdminLayout,

    components: {Link},

    data() {
        return {
            profile: {
                gender: null
            }
        }
    },

    methods: {
        storeProfile(){
            axios.post(route('admin.profiles.store'), this.profile)
                .then(res => {
                    console.log(res)
                })
        }
    }

}
</script>

<style scoped>

</style>
