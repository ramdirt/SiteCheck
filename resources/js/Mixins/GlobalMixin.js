import { usePage } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default function () {
    const props_page = usePage().props.value;
    const is_admin = Boolean(props_page.auth.user.is_admin);
    const user = props_page.auth.user;
    const sites = props_page.sites
    const token = user.api_token

    return { props_page, is_admin, user, sites, token }
}