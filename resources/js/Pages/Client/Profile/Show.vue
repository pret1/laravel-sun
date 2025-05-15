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
            <div>
                Subscribed to {{ localSubscriptionsCount }} people
            </div>
            <div>
                This profile is followed by {{ localFollowersCount }} people
            </div>
            <div v-if="!isOwnProfile" class="mb-4 bg-white p-4 border border-gray-200">
                <a @click.prevent="toggleSubscriber"
                   :class="[profile.is_subscriber ? 'text-blue-600' : 'text-white bg-blue-600', 'inline-block px-3 py-2 mr-2 text-sm border border-blue-600']"
                   href="#"
                   v-html="profile.is_subscriber ? 'Unsubscribe' : 'Subscribe'"
                ></a>
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
        authProfileId: Number,
        subscriptionsCount: Number,
        followersCount: Number
    },

    data() {
        return {
            localSubscriptionsCount: this.subscriptionsCount,
            localFollowersCount: this.followersCount,
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
                    console.log(res.data);
                    this.profile.is_subscriber = res.data.is_subscriber
                    this.localSubscriptionsCount = res.data.followers_count
                    this.localFollowersCount = res.data.subscriber_count
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
