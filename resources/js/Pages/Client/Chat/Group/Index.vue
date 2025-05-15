<template>
    <div>
        <div>
            <div class="mb-4 w-1/2 mx-auto">
                  <div class="mb-4 bg-white p-4 border border-gray-200">
                      Group Chat
                  </div>
                  <div class="mb-4 bg-white p-4 border border-gray-200">
                    <div v-for="profile in profiles" :key="profile.id" class="flex justify-between items-center">
                      {{profile.name}}
                      <input type="checkbox" :value="profile.id" v-model="selectedProfiles">
                    </div>
                  </div>
                  <div>
                    <button @click="createGroupChat"
                        class="px-3 py-2 text-white bg-blue-600 border border-blue-800"
                    >Create group</button>
                  </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: 'Index',
    components: {
        Link,
    },

    layout: ClientLayout,

    props: {
      profiles: Array,
    },

    data() {
        return {
          selectedProfiles: []
        }
    },

    methods: {
      createGroupChat() {
        if (this.selectedProfiles.length === 0) {
          alert("Please select at least one profile to create a group chat.");
          return;
        }

        axios.post(route('client.chats.group.store'), {
          profile_ids: this.selectedProfiles,
        })
            .then(response => {
              alert("Group chat created successfully!");
              window.location.href = route('client.chats.show', { chat: response.data.chat_id });
            })
      }
    },

}
</script>

<style>

</style>
