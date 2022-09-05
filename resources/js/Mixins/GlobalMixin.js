import { usePage } from "@inertiajs/inertia-vue3";

export default function () {
    const props_page = usePage().props.value;
    const is_admin = Boolean(props_page.auth.user.is_admin);

    return { props_page, is_admin }
}