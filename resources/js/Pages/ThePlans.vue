<template lang="pug">
Head(title="Оплата")

BreezeAuthenticatedLayout
  .container.mt-4
    section.flex.justify-center.flex-wrap-reverse.gap-x-4
      Card.relative.mb-4.rounded-xl(class="w-[25rem]")
        h3.mb-2.text-xl.font-semibold Бесплатный
        List(border, size="small")
          ListItem Не более 1 сайта
          ListItem Интервал проверок не реже 2-х раз в сутки
          ListItem Только 1 тип проверки, на доступность
        .flex.justify-end.mt-4.flex-col
          h2.mb-4.text-lg Стоимость: Бесплатно
          Button(
            type="success",
            @click="submit(false)",
            :disabled="!paid_status"
          ) Оплатить
      Card.relative.mb-4.rounded-xl(class="w-[25rem]")
        h3.mb-2.text-xl.font-semibold PRO
        List(border, size="small")
          ListItem Нет ограничения на количество сайтов
          ListItem Интервал проверок до 5 минут
          ListItem Все доступные виды проверок
        .flex.justify-end.mt-4.flex-col
          h2.mb-4.text-lg Стоимость: 99 рублей в месяц
          Button(
            type="success",
            @click="submit(true)",
            :disabled="paid_status"
          ) Оплатить
</template>

<script setup>
import { computed } from "vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const paid_status = computed(() => {
  return user.paid === 0 ? false : true;
});

const user = usePage().props.value.auth.user;

const form = useForm({
  paid: false,
});

const submit = (status) => {
  form.paid = status;
  form.put(route("plans.update", { id: user.id }), {
    onSuccess: () => {
      console.log("успешно отправлено");
      user.paid = !Boolean(user.paid);
    },
  });
};
</script>