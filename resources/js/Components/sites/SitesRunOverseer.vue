<template lang='pug'>
Card.relative.mb-4.rounded-xl(v-if="is_admin")
  h3.text-lg.font-semibold Запустить проверку
  p.mb-2 для всех пользователей
  Button(type="success", @click="start_check", icon="md-play") Запустить
</template>
    
<script setup>
import { Message } from "view-ui-plus";
import GlobalMixin from "../../Mixins/GlobalMixin";

const { is_admin } = GlobalMixin();

const start_check = () => {
  Message.success("Проверка успешно запущена");
  return axios.get(route("overseer"));
};
</script>