<template>
    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{profile.name}}
            </div>
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <Link method="post" :href="route('client.chats.store')"  :data="{ profile_id: profile.id }">Start chat</Link>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: 'Show',
    components: {
        Link,
    },

    layout: ClientLayout,

    props: {
        profile: Object
    },

    data() {
        return {

        }
    },

    methods: {

    }

}
</script>

<style>

</style>
