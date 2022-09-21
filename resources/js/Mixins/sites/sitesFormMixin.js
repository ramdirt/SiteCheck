import { useForm } from "@inertiajs/inertia-vue3";
import { Message } from "view-ui-plus";
import { computed } from "vue";
import { useStore } from "@/Stores/index";

export default function () {
  props: {
    errors: Object
  }

  const store = useStore();


  const form = useForm('CreateSite', {
    name: "",
    url: "",
  });


  const validateForm = computed(() => {
    const regexp = /\w{1,200}\.\w{1,10}[a-zA-Z]/;
    if (!regexp.test(form.url)) {
      return false;
    }
    if (!form.name) {
      return false;
    }
    if (!form.url) {
      return false;
    }

    return true;
  });


  const validateURL = (rule, value, callback) => {
    if (!value) {
      callback(new Error("Введите адрес сайта в формате site.ru"));
    } else if (/w{1,200}\.w{1,10}[a-zA-Z]/.test(value)) {
      callback("Адрес сайта введен корректно");
    } else {
      callback();
    }
  };


  const rules = {
    name: [{ required: true, message: "Введите имя сайта", trigger: "blur" }],
    url: [
      {
        validator: validateURL,
        trigger: "blur",
      },
    ],
  };


  const submit = () => {
    form.post(route("sites.store"), {
      onSuccess: () => {
        if (typeof errors === 'undefined') {
          Message.success("Запись добавлена, обновите страницу");
          store.getSites();
        }
      },
      onError: (errors) => {
        if (errors.url) {
          Message.error(errors.url)
        } else {
          Message.error('Ошибка добавления')
        }
      }
    });
  };


  return { form, rules, validateForm, submit }
}