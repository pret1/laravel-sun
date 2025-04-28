<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Statistics</h1>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Posts</th>
                <th class="px-4 py-2 border">Comments</th>
                <th class="px-4 py-2 border">Likes</th>
                <th class="px-4 py-2 border">Views</th>
                <th class="px-4 py-2 border">Likes/Views (%)</th>
                <th class="px-4 py-2 border">Likes/Comments (%)</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="statistic in statistics" :key="statistic.id">
                <td class="px-4 py-2 border">{{ statistic.date }}</td>
                <td class="px-4 py-2 border">{{ statistic.posts_count }}</td>
                <td class="px-4 py-2 border">{{ statistic.comments_count }}</td>
                <td class="px-4 py-2 border">{{ statistic.likes_count }}</td>
                <td class="px-4 py-2 border">{{ statistic.views_count }}</td>
                <td class="px-4 py-2 border">{{ statistic.likes_to_views_ratio ?? '-' }}</td>
                <td class="px-4 py-2 border">{{ statistic.likes_to_comments_ratio ?? '-' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Index',

    layout: AdminLayout,

    components: {Link},

    props: {
        statistics: Object
    }
}
</script>
