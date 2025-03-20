<template>
    <div>
        <div v-for="profile in profiles">
            <Link :href="route('admin.profiles.show', profile.id)">{{ profile.name }}</Link>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Index',

    components: {Link},

    props: {
        profiles: Array
    }
}
</script>

<style scoped>

</style>
