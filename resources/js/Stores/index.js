import { defineStore } from 'pinia'
import { usePage } from "@inertiajs/inertia-vue3";


export const useStore = defineStore('counter', {
    state: () => {
        return {
            sites: [],
            props_page: usePage().props.value,
        }
    },
    getters: {
        token: (state) => state.props_page.auth.user.api_token,
        user: (state) => state.props_page.auth.user,
        is_admin: (state) => Boolean(state.props_page.auth.user.is_admin)
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