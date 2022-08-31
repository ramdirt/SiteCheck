<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.max-w-6xl
    Button.ml-2.ml-10(:to="route('sites.index')") Назад
  .container.mt-4.flex.gap-4.flex-wrap.justify-center
    section.w-full.sx__max-w-lg.lg__max-w-2xl.lg__w-96
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавить страницу

        Form(:model="form", :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Название страницы", v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="/адрес_страницы", v-model="form.url")

          .flex.justify-end
            Button(type="primary", @click="submit") Добавить

    section.w-full.sx__max-w-lg.lg__max-w-2xl
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Страницы сайта

        Table(:columns="table.columns", :data="table.data")
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { Button } from "view-ui-plus";

const props = usePage().props.value;

const user = props.auth.user;
const pages = props.pages;

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
      key: "updated_at",
      render: (h, { row }) => {
        return h("p", formatDate(row.updated_at));
      },
    },
    {
      title: "Действия",
      key: "action",
      width: 120,
      render: (h, { row }) => {
        return h("div", [
          h(Button, {
            type: "danger",
            class: "mr-1",
            icon: "md-trash",
            to: "google.com",
          }),
          h(Button, {
            type: "primary",
            icon: "md-hammer",
            to: "google.com",
          }),
        ]);
      },
    },
  ],
  data: pages,
};

const form = useForm({
  name: "",
  path: "",
});

const rules = {
  name: [{ required: true }],
  path: [{ required: true }],
};

const color_status = (status) => {
  if (status !== 1) {
    return "rgb(239 68 68)";
  } else {
    return "rgb(34 197 94)";
  }
};

const formatDate = (date) => new Date(date).toLocaleTimeString();

const submit = () => {
  form.post(route("sites.store"), {
    onSuccess: () => {
      console.log("успешно отправлено");
    },
  });
};
</script>
