<template>
    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{profile.name}}
            </div>
            <div v-if="!isOwnProfile" class="mb-4 bg-white p-4 border border-gray-200">
                <Link
                 method="post"
                 :href="route('client.chats.store')"
                 :data="{ profile_id: profile.id }"
                 >Start chat</Link>
            </div>
            <div v-if="!isOwnProfile" class="mb-4 bg-white p-4 border border-gray-200">
                <a @click.prevent="toggleSubscriber"
                   class="inline-block px-3 py-2 mr-2 text-sm text-white bg-blue-600"
                   href="#"
                >Subscribe</a>
                <a class="inline-block px-3 py-2 text-sm text-blue-600 border border-blue-600" href="#">Unsubscribe</a>
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
        profile: Object,
        authProfileId: Number
    },

    data() {
        return {

        }
    },

    mounted() {
      // console.log(this.$page.props.auth.user.id)
      // console.log(this.$page.props.profile.id)
      // console.log(this.$page.props.auth.user.profile.id)
      // console.log(this.$attrs.auth.user.id)
    },

    methods: {
        toggleSubscriber() {
            axios.post(route('client.profiles.toggle-subscribe', this.$page.props.auth.user.profile.id), {
                subscriber_id: this.profile.id
            })
                .then(res => {
                    this.profile.is_subscriber = res.is_subscriber
                })
        }
    },

    computed: {
        isOwnProfile() {
            return this.profile.id === this.authProfileId;
        }
    }

}
</script>

<style>

</style>
