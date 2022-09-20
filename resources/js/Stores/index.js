import { defineStore } from 'pinia'
import { usePage } from "@inertiajs/inertia-vue3";


export const useStore = defineStore('counter', {
    state: () => {
        return {
            sites: [],
            props_page: usePage().props.value,
            token: usePage().props.value.auth.user.api_token,
            user: usePage().props.value.auth.user,
            is_admin: Boolean(usePage().props.value.auth.user.is_admin)
        }
    },
    actions: {
        async getSites() {
            await axios.get('/api/sites', { headers: { "Authorization": `Bearer ${this.token}` } })
                .then((response) => {
                    this.sites = response.data;
                })
                .catch((error) => {
                })
        },
    },
})