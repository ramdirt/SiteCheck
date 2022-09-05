<template lang='pug'>
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
</template>

<script setup>
import sitesFormMixin from "../../Mixins/sites/sitesFormMixin";

const { form, rules, validateForm, submit } = sitesFormMixin();
</script>