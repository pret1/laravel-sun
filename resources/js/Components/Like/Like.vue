<template>
    <div>
        <div class="flex justify-end">
            <span>{{ item.likes}}</span>
            <svg v-if="!readonly" @click="toggleLike(item.id)" xmlns="http://www.w3.org/2000/svg"
                 :fill="item.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="cursor-pointer size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
            <svg v-else
                 xmlns="http://www.w3.org/2000/svg"
                 :fill="item.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'Like',

    props: {
        item: Object,
        routeName: String,
        onRefresh: Function,
        readonly: Boolean
    },

    methods: {
        toggleLike(id) {
            axios.post(route(this.routeName, id))
                .then(res => {
                    if ('liked_profiles_count' in res.data) {
                        this.item.is_liked = res.data.is_liked;
                        this.item.likes = res.data.liked_profiles_count;
                    } else {
                        this.item.is_liked = res.data.is_liked;
                        this.item.likes = res.data.likes;
                    }

                    if (this.onRefresh) this.onRefresh();
                })
        },
    }
}
</script>

<style scoped>

</style>
