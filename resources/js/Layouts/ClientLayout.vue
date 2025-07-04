<template>
    <section class="w-full">
        <header class="mx-auto p-4 flex justify-between">
            <div>HEADER Dashboard</div>
            <div class="cursor-pointer notify-block" v-if="$page.props.auth.user.user_notifications_count > 0">
                <div class="flex items-center" @click="toggleNotify">
                    <div class="mr-1">
                        {{ unreadCount }}
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>
                    </div>
                </div>
                <div class="notify-content" v-if="showNotify">
                    <div v-for="notification in unreadNotifications" :key="notification.id" class="p-2 border-b border-gray-300">
                        <div class="text-sm text-gray-700">{{ notification.content }}</div>
                        <div class="text-xs text-gray-500">{{ notification.created_at }}</div>
                    </div>
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
import axios from "axios";
export default {
    name: 'ClientLayout',
    data() {
        return {
            showNotify: false,
            notifications: this.$page.props.auth.user.notifications || [],
        }
    },
    computed: {
        unreadNotifications() {
            return this.notifications.filter(n => !n.read_at);
        },
        unreadCount() {
            return this.unreadNotifications.length;
        }
    },
    created() {
        Echo.private(`user-notification.${this.$page.props.auth.user.id}`)
            .listen('.UserNotification', (e) => {
                console.log(e);
                this.notifications.unshift(e.message);
            });
    },
    methods: {
        toggleNotify() {
            if (this.showNotify && this.unreadCount > 0) {
                axios.post(route('client.notifications.read'), {
                    notifications: this.notifications
                })
                    .then((res) => {
                        this.notifications = res.data.notifications;
                    });
            }
            this.showNotify = !this.showNotify;
        }
    }
}
</script>

<style scoped>
.notify-block {
    position: relative;
}
.notify-content {
    width: 400px;
    max-height: 600px;
    background: #eac87b;
    position: absolute;
    top: 100%;
    right: 0;
    overflow-y: auto;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
</style>
