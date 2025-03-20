<template>
    <div>
        <div>
            {{profile.name}} <br>
            {{profile.phone}} <br>
            {{profile.address}}
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Show',

    components: {Link},

    props: {
        profile: Object
    }
}
</script>

<style scoped>

</style>
