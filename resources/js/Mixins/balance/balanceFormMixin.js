import { useForm } from "@inertiajs/inertia-vue3";
import { Message } from "view-ui-plus";
import GlobalMixin from "@/Mixins/GlobalMixin";

export default function () {
    const { user } = GlobalMixin();

    const form = useForm("MakePayment", {
        payment: null,
    });

    const rules = {
        payment: [
            { required: true, message: "Введите сумму в рублях", trigger: "blur" },
        ],
    };

    const submit = () => {
        form.put(route("balance.update", { id: user.id }), {
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
