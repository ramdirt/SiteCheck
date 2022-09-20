<template lang='pug'>
Card.sc__card(v-if="store.user.is_admin")
  h3.sc__title Запустить проверку
  p.mb-2 для всех пользователей
  Button(type="success", @click="start_check", icon="md-play") Запустить
</template>
    
<script setup>
import { Message } from "view-ui-plus";

import { useStore } from "@/Stores/index";

const store = useStore();

const start_check = () => {
  Message.success("Проверка успешно запущена");
  return axios.get(route("chief"));
};
</script>