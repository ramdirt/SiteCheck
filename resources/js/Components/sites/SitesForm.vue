<template lang='pug'>
Card.sc__card
  h3.sc__title Добавить сайт

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
import sitesFormMixin from "@/Mixins/sites/sitesFormMixin";

const { form, rules, validateForm, submit } = sitesFormMixin();
</script>