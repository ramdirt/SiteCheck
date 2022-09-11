import { usePage } from "@inertiajs/inertia-vue3";

export default function () {
    const props_page = usePage().props.value;
    const is_admin = Boolean(props_page.auth.user.is_admin);
    const user = usePage().props.value.auth.user;

    return { props_page, is_admin, user }
}