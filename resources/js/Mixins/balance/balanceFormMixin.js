import { useForm } from "@inertiajs/inertia-vue3";
import { Message } from "view-ui-plus";
import { useStore } from "@/Stores/index";


export default function () {
    const store = useStore();

    const form = useForm("MakePayment", {
        payment: null,
    });

    const rules = {
        payment: [
            { required: true, message: "Введите сумму в рублях", trigger: "blur" },
        ],
    };

    const submit = () => {
        form.put(route("balance.update", { id: store.user.id }), {
            onSuccess: () => {
                if (typeof errors === "undefined") {
                    Message.success("Запись добавлена, обновите страницу");
                }
            },
            onError: (errors) => {
                Message.error("Ошибка пополнения");
            },
        });
    };

    return { form, rules, submit };
}
