<template lang='pug'>
Modal(v-model="dataModal.open", :title="dataModal.title", :closable="true")
  .flex.flex-col
    p Статус: {{ dataModal.status }}
    p {{ dataModal.last_check }}
    a(:href="dataModal.url") Перейти на сайт
    Button(@click="deleteSite(dataModal.id)", type="error", icon="md-trash") Удалить сайт
</template>
    
<script setup>
import { defineProps } from "vue";
import { Message } from "view-ui-plus";
import { useStore } from "@/Stores/index";

const store = useStore();

defineProps({
  dataModal: Object,
});

const deleteSite = (id) => {
  axios.delete(route("sites.destroy", { id: id }));
  store.getSites();
  Message.success("Запись удалена");
};
</script>