<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.lg__flex.lg__space-x-6
    section
      Card.relative.mb-4.rounded-xl(class="w-[30rem]")
        h3.mb-4.text-lg.font-semibold Добавить сайт

        Form(:model="form", :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Введите название сайта", v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="https://example.com", v-model="form.url")

          .flex.justify-end
            Button(type="primary", @click="submit") Добавить

    section.w-full
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавленные сайты

        Table(:columns="table.columns", :data="table.data")
</template>

<script setup>
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";

const props = usePage().props.value;

const user = props.auth.user;
const sites = props.sites;

const table = {
  columns: [
    {
      title: "Статус",
      key: "status",
    },
    {
      title: "Название",
      key: "name",
    },
    {
      title: "Последняя проверка",
      key: "last_check",
    },
    {
      title: "Подробнее",
      key: "detail",
      render: (h, { row }) => {
        return h("div", [
          h(
            Link,
            {
              // TODO: Указать правильный роут когда будет контроллер с страницами
              href: route("sites.index", { id: row.id }),
            },
            () => [h("span", "Подробнее...")]
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

const submit = () => {
  form.post(route("sites.store"), {
    onSuccess: () => {
      console.log("успешно отправлено");
    },
  });
};
</script>
