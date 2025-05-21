<template>
    <section class="w-full">
        <header class="mx-auto p-4 flex justify-between">
            <div>HEADER Dashboard</div>
            <div class="cursor-pointer notify-block">
                <div class="flex items-center ">
                    <div class="mr-1">
                        {{ this.$page.props.auth.user.user_notifications_count }}
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>
                    </div>
                </div>
                <div class="notify-content">
                </div>
            </div>
        </header>
    </section>
    <section class="w-full bg-gray-50">
        <section class="mx-auto flex">
            <article class="w-1/2 p-4 mx-auto">
                <slot></slot>
            </article>
        </section>
    </section>
</template>

<script>
export default {
    name: 'ClientLayout',

}
</script>

<style scoped>
.notify-block {
    position: relative;
}

.notify-content {
    width: 400px;
    height: 600px;
    background: #eac87b;
    position: absolute;
    top: 100%;
    right: 0;
    overflow-y: auto;
}
</style>
