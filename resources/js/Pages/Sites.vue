<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.lg__flex.gap-4.justify-center
    section.w-full.sx__max-w-lg.lg__max-w-2xl.lg__w-96
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавить сайт

        Form(:model="form", :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Введите название сайта", v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="example.com", v-model="form.url")

          .flex.justify-end
            Button(type="primary", @click="submit", icon="md-add-circle") Добавить
      Card.relative.mb-4.rounded-xl(v-if="is_admin()")
        h3.text-lg.font-semibold Запустить проверку
        p.mb-2 для всех пользователей
        Button(type="success", @click="start_check", icon="md-play") Запустить

    section.w-full.sx__max-w-lg.lg__max-w-2xl
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавленные сайты

        Table(:columns="table.columns", :data="table.data")
</template>

<script setup>
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Button } from "view-ui-plus";

const props = usePage().props.value;

const user = props.auth.user;
const sites = props.sites;
const is_admin = () => user.is_admin === 1;

const table = {
  columns: [
    {
      title: "Статус",
      width: 90,
      key: "status",
      render: (h, { row }) => {
        return h("div", {
          style: {
            background: color_status(row.status),
          },
          class: "w-8 h-4 rounded-full border",
        });
      },
    },
    {
      title: "Название",
      key: "name",
    },
    {
      title: "Последняя проверка",
      key: "last_check",
      width: 200,
      render: (h, { row }) => {
        return h("p", formatDate(row.last_check));
      },
    },
    {
      title: "Действия",
      key: "detail",
      render: (h, { row }) => {
        return h("div", [
          h(
            Button,
            {
              type: "primary",
              icon: "md-information-circle",
              to: route("sites.show", { id: row.id }),
            },
            "Подробнее"
          ),
        ]);
      },
    },
  ],
  data: sites,
};

const form = useForm({
  name: "",
  url: "",
});

const rules = {
  name: [{ required: true }],
  email: [{ required: true }],
};

const start_check = () => {
  return axios.get(route("overseer"));
};

const formatDate = (date) => new Date(date).toLocaleTimeString();

const color_status = (status) => {
  if (status !== 1) {
    return "rgb(239 68 68)";
  } else {
    return "rgb(34 197 94)";
  }
};

const submit = () => {
  form.post(route("sites.store"), {
    onSuccess: () => {
      console.log("успешно отправлено");
    },
  });
};
</script>
