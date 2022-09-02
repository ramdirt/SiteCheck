<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.lg__flex.gap-4.justify-between.max-w-6xl
    section.w-full.sx__max-w-lg.lg__max-w-2xl.lg__w-96
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавить сайт

        Form(:model="form", :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Введите название сайта", v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="example.com", v-model="form.url")

          .flex.justify-end
            Button(
              type="primary",
              :disabled="!validateForm",
              @click="submit",
              icon="md-add-circle"
            ) Добавить
      Card.relative.mb-4.rounded-xl(v-if="is_admin()")
        h3.text-lg.font-semibold Запустить проверку
        p.mb-2 для всех пользователей
        Button(type="success", @click="start_check", icon="md-play") Запустить

    section.w-full.sx__max-w-lg.lg__max-w-3xl
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавленные сайты

        Table(:columns="table.columns", :data="table.data")
</template>

<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import sitesMixin from "./mixins/sitesMixin";
import sitesFormMixin from "./mixins/sitesFormMixin";

const table = sitesMixin();
const { form, rules, validateForm, submit } = sitesFormMixin();

const props = usePage().props.value;
const is_admin = () => props.auth.user.is_admin === 1;

const start_check = () => {
  return axios.get(route("overseer"));
};
</script>
